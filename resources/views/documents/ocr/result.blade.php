@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>OCR Extracted Text</h2>

    <pre style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; white-space: pre-wrap; font-family: monospace;">
{{ $text }}
    </pre>

    <a href="{{ route('image.upload.form') }}" class="btn btn-secondary mt-3">
        Upload Another Image
    </a>
</div>
@endsection
