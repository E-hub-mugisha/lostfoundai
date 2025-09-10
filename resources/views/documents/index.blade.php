@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h2 class="mt-4">Lost Documents</h2>

            <!-- Add Lost ID Button -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="bi bi-plus-circle"></i> Report Lost ID
            </button>
        </div>
    </div>
    <!-- Lost IDs Table -->
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="table table-bordered table-hover align-middle datatable-init nowrap">
                <thead class="table-light">
                    <tr>
                        <th>Full Name</th>
                        <th>ID Number</th>
                        <th>Date of Birth</th>
                        <th>Sex</th>
                        <th>Place of Issue</th>
                        <th>Status</th>
                        <th>Date Reported</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lostDocs as $lost)
                    <tr>
                        <td>{{ $lost->names }}</td>
                        <td>{{ $lost->id_number ?? '-' }}</td>
                        <td>{{ $lost->dob ?? '-' }}</td>
                        <td>{{ $lost->sex ?? '-' }}</td>
                        <td>{{ $lost->place_of_issue ?? '-' }}</td>
                        <td>
                            @if($lost->status === 'new')
                            <span class="badge bg-primary">New</span>
                            @elseif($lost->status === 'match')
                            <span class="badge bg-danger">Matched</span>
                            @elseif($lost->status === 'verified')
                            <span class="badge bg-success">Verified</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($lost->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $lost->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            <!-- Verify Button -->
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#verifyIdModal{{ $lost->id }}">
                                <i class="bi bi-check-circle"></i> Verify
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $lost->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MODALS ================= -->

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="uploadModalLabel"><i class="bi bi-plus-circle"></i> Report Lost ID</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lost.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Upload Scanned image</label>
                                <input type="file" name="document" class="form-control" required>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Verify Modals -->
    @foreach($lostDocs as $lost)
    <div class="modal fade" id="verifyIdModal{{ $lost->id }}" tabindex="-1" aria-labelledby="verifyIdModalLabel{{ $lost->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="verifyIdModalLabel{{ $lost->id }}"><i class="bi bi-check-circle"></i> Verify Lost ID</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lost-documents.verify', $lost->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p><strong>Full Name:</strong> {{ $lost->names }}</p>
                                <p><strong>ID Number:</strong> {{ $lost->id_number ?? '-' }}</p>
                                <p><strong>Date of Birth:</strong> {{ $lost->dob ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="{{ asset($lost->file_path) }}" class="img-fluid rounded border p-2" style="max-width:80%;">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Verify</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Delete Modals -->
    @foreach($lostDocs as $lost)
    <div class="modal fade" id="deleteModal{{ $lost->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $lost->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel{{ $lost->id }}"><i class="bi bi-trash"></i> Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the report for <strong>{{ $lost->names }}</strong> (ID: {{ $lost->id_number ?? '-' }})?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('lost-documents.destroy', $lost) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection