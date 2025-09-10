@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>My Lost ID Reports</h2>

  <!-- Success message -->
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Add Lost ID Button -->
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addLostIdModal">+ Report Lost ID</button>

  <!-- Lost IDs Table -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>ID Number</th>
        <th>ID Type</th>
        <th>Date Lost</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($lostDocs as $lost)
      <tr>
        <td>{{ $lost->full_name }}</td>
        <td>{{ $lost->id_number ?? '-' }}</td>
        <td>{{ $lost->id_type }}</td>
        <td>{{ $lost->date_lost ?? '-' }}</td>
        <td><span class="badge bg-info">{{ ucfirst($lost->status) }}</span></td>
        <td>
          <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#viewLostIdModal{{ $lost->id }}">View</button>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editLostIdModal{{ $lost->id }}">Edit</button>
          <form action="{{ route('lost-documents.destroy', $lost) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Delete this lost ID report?')" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
</div>

@foreach($lostDocs as $lost)
<!-- Edit Lost ID Modal -->
<div class="modal fade" id="editLostIdModal{{ $lost->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ route('lost-documents.update', $lost) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Lost ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input name="full_name" class="form-control mb-2" value="{{ $lost->full_name }}" required>
        <input name="id_number" class="form-control mb-2" value="{{ $lost->id_number }}">
        <select name="id_type" class="form-control mb-2" required>
          <option value="NID" {{ $lost->id_type == 'NID' ? 'selected' : '' }}>National ID</option>
          <option value="Passport" {{ $lost->id_type == 'Passport' ? 'selected' : '' }}>Passport</option>
          <option value="License" {{ $lost->id_type == 'License' ? 'selected' : '' }}>Driver's License</option>
        </select>
        <input type="date" name="date_lost" class="form-control mb-2" value="{{ $lost->date_lost }}">
        <input name="location_lost" class="form-control mb-2" value="{{ $lost->location_lost }}">
        <input type="file" name="image" class="form-control mb-2">
        @if($lost->image)
        <img src="{{ asset('storage/'.$lost->image) }}" class="img-fluid rounded mt-2" width="100">
        @endif
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>
@endforeach

@foreach($lostDocs as $lost)
<!-- View Lost ID Modal -->
<div class="modal fade" id="viewLostIdModal{{ $lost->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lost ID Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Full Name:</strong> {{ $lost->full_name }}</p>
        <p><strong>ID Number:</strong> {{ $lost->id_number ?? '-' }}</p>
        <p><strong>ID Type:</strong> {{ $lost->id_type }}</p>
        <p><strong>Date Lost:</strong> {{ $lost->date_lost ?? '-' }}</p>
        <p><strong>Location:</strong> {{ $lost->location_lost ?? '-' }}</p>
        @if($lost->image)
        <p><strong>Photo:</strong></p>
        <img src="{{ asset('storage/'.$lost->image) }}" class="img-fluid rounded">
        @endif
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Add Lost ID Modal -->
<div class="modal fade" id="addLostIdModal" tabindex="-1" aria-labelledby="addLostIdModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ route('lost-documents.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Report Lost ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input name="full_name" class="form-control mb-2" placeholder="Full Name" required>
        <input name="id_number" class="form-control mb-2" placeholder="ID Number (optional)">
        <select name="id_type" class="form-control mb-2" required>
          <option value="">-- Select ID Type --</option>
          <option value="NID">National ID</option>
          <option value="Passport">Passport</option>
          <option value="License">Driver's License</option>
        </select>
        <input type="date" name="date_lost" class="form-control mb-2">
        <input name="location_lost" class="form-control mb-2" placeholder="Where it got lost?">
        <input type="file" name="image" class="form-control mb-2">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection