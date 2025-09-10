<?php

namespace App\Http\Controllers;

use App\Models\ExtractedDocument;
use App\Models\FoundDocument;
use App\Models\LostDocument;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $foundCount = ExtractedDocument::where('status', 'found')->count();
        $lostCount = ExtractedDocument::where('status', '!=', 'found')->count();
        $userCount = User::count();

        $recentFoundDocs = ExtractedDocument::latest()->take(10)->get();

        // graph data can be prepared here if needed
        $graphData = [
            'labels' => ['Found', 'Lost'],
            'data' => [$foundCount, $lostCount],
        ];

        return view('dashboard', compact('foundCount', 'lostCount', 'userCount', 'recentFoundDocs', 'graphData'));
    }

    public function reports()
    {
        $lostDocs = LostDocument::with('user')->get();
        $foundDocs = FoundDocument::with('user')->get();

        return view('documents.reports', compact('lostDocs', 'foundDocs'));
    }

    // Display filtered reports
    public function index(Request $request)
    {
        $query = ExtractedDocument::query();

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $reports = $query->get();

        return view('documents.reports', compact('reports'));
    }

    // Download report as CSV
    public function download(Request $request)
    {
        $query = ExtractedDocument::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $reports = $query->get();

        $filename = 'reports_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Full Name', 'ID Number', 'Date of Birth', 'Status'];

        $callback = function () use ($reports, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $report) {
                fputcsv($file, [
                    $report->full_name,
                    $report->id_number,
                    $report->date_of_birth,
                    $report->status,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadPdf(Request $request)
    {
        $query = ExtractedDocument::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $reports = $query->get();

        $pdf = Pdf::loadView('documents.report_pdf', compact('reports'));

        $filename = 'reports_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}
