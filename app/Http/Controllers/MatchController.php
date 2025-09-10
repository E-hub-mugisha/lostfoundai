<?php

namespace App\Http\Controllers;

use App\Models\MatchReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function index()
    {
        $matches = MatchReport::whereHas('lost', function ($q) {
            $q->where('user_id', Auth::id());
        })->orWhereHas('found', function ($q) {
            $q->where('user_id', Auth::id());
        })->with(['lost', 'found'])->latest()->get();

        return view('documents.matches.index', compact('matches'));
    }
}
