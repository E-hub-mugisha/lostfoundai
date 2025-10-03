@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-check-circle-fill text-success"></i> Extracted Data
        </h2>
        <p class="text-muted">Here are the details we extracted from your uploaded document.</p>
    </div>

    <div class="row justify-content-center">
        <!-- Left: Uploaded Image -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Uploaded Document
                </div>
                <div class="card-body text-center">
                    <img src="{{ $file }}" class="img-fluid rounded border p-2" style="max-width:100%;">
                </div>
            </div>
        </div>

        <!-- Right: Extracted Data -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">
                    Extracted Information
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-person-fill text-primary"></i>
                            <strong> Names:</strong> {{ $document->names }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar-event-fill text-info"></i>
                            <strong> Date of Birth:</strong> {{ $document->dob }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-gender-ambiguous text-warning"></i>
                            <strong> Sex:</strong> {{ $document->sex }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                            <strong> Place of Issue:</strong> {{ $document->place_of_issue }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-credit-card-2-front-fill text-secondary"></i>
                            <strong> ID Number:</strong> {{ $document->id_number }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- JSON Raw Output -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white fw-bold">
            Raw Extracted JSON
        </div>
        <div class="card-body">
            <pre class="bg-light p-3 rounded border">{{ $extracted }}</pre>
        </div>
    </div>

    <!-- Action Button -->
    <div class="text-center mt-4">
        @if($document->status === 'lost')
        <a href="{{ route('documents.index') }}" class="btn btn-lg btn-primary">
            <i class="bi bi-upload"></i> Lost Documents list
        </a>
        @else
        <a href="{{ route('found_documents.index') }}" class="btn btn-lg btn-primary">
            <i class="bi bi-upload"></i> Found Documents list
        </a>
        @endif
    </div>
</div>
@endsection
