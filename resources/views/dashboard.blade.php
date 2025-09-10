@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row mb-4">
        <!-- Summary cards -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Found IDs</h5>
                    <p class="card-text display-5">{{ $foundCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Lost IDs</h5>
                    <p class="card-text display-5">{{ $lostCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text display-5">{{ $userCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
    <h3>Recent Lost Documents</h3>
    <table class="table table-striped table-hover mt-3 datatable-init nowrap">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>ID Number</th>
                <th>Date of Birth</th>
                <th>Date Lost</th>
                <th>Place of Issue</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentFoundDocs as $doc)
            <tr>
                <td>{{ $doc->names }}</td>
                <td>{{ $doc->id_number }}</td>
                <td>{{ $doc->dob}}</td>
                <td>{{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') : '-' }}</td>
                <td>{{ $doc->place_of_issue ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $doc->status == 'matched' ? 'success' : 'secondary' }}">
                        {{ ucfirst($doc->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No found documents yet.</td></tr>
            @endforelse
        </tbody>
    </table>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="row">
    <div class="col-lg-11 bg-light p-4 mx-auto rounded shadow-sm">
        <h3>Document Status Overview</h3>
        <canvas id="statusChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($graphData['labels']) !!},
            datasets: [{
                label: 'Number of Documents',
                data: {!! json_encode($graphData['data']) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endsection
