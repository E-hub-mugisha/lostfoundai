@extends('layouts.app')

@section('content')
<div class="container">
    <h2>OCR Result</h2>

    <h4>🔍 Full Text:</h4>
    <pre>{{ $fullText }}</pre>

    <h4 class="mt-4">📦 Structured Blocks:</h4>
    <ul>
        @foreach ($blocks as $block)
            <li>{{ $block }}</li>
        @endforeach
    </ul>
</div>
@endsection
