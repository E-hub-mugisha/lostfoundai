@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Google Vision OCR</h2>

    <form action="{{ route('vision.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Extract Text</button>
    </form>

    @isset($parsedText)
        <div class="mt-4">
            <h5>Extracted Text:</h5>
            <pre class="border p-3 bg-light">{{ $parsedText }}</pre>
        </div>
    @endisset
</div>
@endsection
