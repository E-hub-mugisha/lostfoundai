@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h2 class="mt-4">Generate Reports</h2>
        </div>
    </div>

    <!-- filter to generate report -->
    <div class="card card-bordered card-preview mb-4">
        <div class="card-inner">
            <form action="{{ route('documents.reports') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="match" {{ request('status') == 'match' ? 'selected' : '' }}>Matched</option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-4">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </form>
        </div>
    </div>
    @if(isset($reports))
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <h5 class="mb-3">Report Results</h5>
            <!-- button download report -->
            <div class="mb-3">
                <a href="{{ route('documents.reports.download', request()->query()) }}" class="btn btn-secondary">Download Report</a>
                <a href="{{ route('documents.reports.downloadPdf', request()->query()) }}" class="btn btn-secondary">Download PDF</a>
            </div>
            <table class="table table-bordered table-hover align-middle datatable-init nowrap">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>ID Number</th>
                        <th>Gender</th>
                        <th>Place of Issue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->names }}</td>
                        <td>{{ $report->id_number }}</td>
                        <td>{{ $report->sex }}</td>
                        <td>{{ $report->place_of_issue }}</td>
                        <td>{{ $report->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
