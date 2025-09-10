@extends('layouts.app')

@section('content')
<form action="{{ route('documents.preview') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="document">Upload ID or Passport:</label>
    <input type="file" name="document" accept="image/*" required>
    <button type="submit">Extract Text</button>
</form>

<form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="document">Upload ID / Passport</label>
    <input type="file" name="document" required>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
@endsection
