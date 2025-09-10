@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <!-- Header -->
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i> Duplicate Found
                </h5>
            </div>

            <!-- Body -->
            <div class="modal-body bg-light">
                <div class="alert alert-danger fw-bold d-flex align-items-center justify-content-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                    This ID <span class="ms-1 badge bg-dark">{{ $document->id_number }}</span> already exists in the database!
                </div>

                <!-- Document Details Card -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body text-start">
                        <h5 class="fw-bold text-secondary mb-3">
                            <i class="bi bi-person-badge-fill me-2"></i> Document Information
                        </h5>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="bg-light text-end"><i class="bi bi-person-fill"></i> Names</th>
                                <td>{{ $document->names }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-end"><i class="bi bi-card-text"></i> ID Number</th>
                                <td>{{ $document->id_number }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-end"><i class="bi bi-calendar"></i> Date of Birth</th>
                                <td>{{ $document->dob }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-end"><i class="bi bi-geo-alt"></i> Place of Issue</th>
                                <td>{{ $document->place_of_issue }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer d-flex justify-content-between">
                <a href="{{ route('documents.index-ai') }}" class="btn btn-lg btn-primary d-flex align-items-center">
                    <i class="bi bi-table me-2"></i> View Lost Documents Table
                </a>
                <a href="{{ route('documents.upload') }}" class="btn btn-lg btn-outline-secondary d-flex align-items-center">
                    <i class="bi bi-upload me-2"></i> Upload Another
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
