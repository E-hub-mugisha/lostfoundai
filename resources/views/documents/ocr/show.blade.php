@extends('layouts.app')

@section('content')
<div class="container mt-4 text-center">
    <h2>Uploaded Image Preview</h2>

    <img src="{{ asset($image->image_data) }}" 
         alt="Uploaded Image" 
         style="max-width: 500px; max-height: 500px; margin-bottom: 20px;" />

    <div>
        <a href="{{ route('image.extractText', $image->id) }}" class="btn btn-primary">
            Extract Text (OCR)
        </a>
    </div>
</div>
@endsection
