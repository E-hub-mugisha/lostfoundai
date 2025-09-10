@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">🔍 Possible Match Found</h2>

    <div class="row g-4 justify-content-center">
        <!-- Found Document Card -->
        <div class="col-md-5">
            <div class="card shadow-sm border-primary h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Found Document</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $foundDoc->image) }}" class="img-fluid rounded mb-3" alt="Found Document Image" style="max-height: 300px;">
                    <p><strong>Name:</strong> <span class="badge bg-info">{{ $foundDoc->full_name }}</span></p>
                    <p><strong>ID Number:</strong> <span class="badge bg-secondary">{{ $foundDoc->id_number ?? 'N/A' }}</span></p>
                    <p><strong>Type:</strong> <span class="badge bg-warning text-dark">{{ $foundDoc->id_type }}</span></p>
                </div>
            </div>
        </div>

        <!-- Lost Document Card -->
        <div class="col-md-5">
            <div class="card shadow-sm border-success h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Lost Document</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $lostDoc->image) }}" class="img-fluid rounded mb-3" alt="Lost Document Image" style="max-height: 300px;">
                    <p><strong>Name:</strong> <span class="badge bg-info">{{ $lostDoc->full_name }}</span></p>
                    <p><strong>ID Number:</strong> <span class="badge bg-secondary">{{ $lostDoc->id_number ?? 'N/A' }}</span></p>
                    <p><strong>Type:</strong> <span class="badge bg-warning text-dark">{{ $lostDoc->id_type }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-4">
        <form action="{{ route('documents.match.confirm', [$foundDoc->id, $lostDoc->id]) }}" method="POST" class="d-inline-block me-2">
            @csrf
            <button type="submit" class="btn btn-success btn-lg px-4">✅ Confirm Match</button>
        </form>
        <a href="{{ route('found_documents.index') }}" class="btn btn-outline-secondary btn-lg px-4">❌ Cancel</a>
    </div>
</div>
@endsection
