@extends('layouts.app')

@section('content')
    <h3>Extracted Text Preview</h3>

@if($text)
    <pre>{{ $text }}</pre>
@else
    <p style="color: red;">No text was extracted. Try a clearer image or check OCR settings.</p>
@endif

<img src="{{ asset('storage/' . $imagePath) }}" alt="Enhanced Document" style="max-width: 400px;">

<form action="{{ route('documents.store') }}" method="POST">
    @csrf
    <input type="hidden" name="image_path" value="{{ $imagePath }}">
    <input type="hidden" name="extracted_text" value="{{ $text }}">
    <button type="submit">Confirm & Submit</button>
</form>


@endsection