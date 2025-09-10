@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload ID Card</h2>
    <form method="POST" action="{{ route('ocr.process') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="image" class="form-control" required>
        </div>
        <button class="btn btn-primary">Analyze</button>
    </form>
</div>
@endsection
