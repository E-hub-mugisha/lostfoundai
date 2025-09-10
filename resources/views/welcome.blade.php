@extends('layouts.guest')

@section('title', 'Lost & Found AI')

@section('content')
<style>
    body {
        background: #fff;
        color: #000;
        font-family: 'Segoe UI', sans-serif;
    }

    .btn-primary {
        background: #ffd700;
        border: none;
        color: #000;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: #e6c200;
        color: #000;
    }

    .btn-outline-primary {
        color: #ffd700;
        border-color: #ffd700;
    }

    .btn-outline-primary:hover {
        background: #ffd700;
        color: #000;
        border-color: #ffd700;
    }

    h1.display-4, h2, h3, h4 {
        text-shadow: 2px 2px 6px rgba(0,0,0,0.3);
    }

    p {
        text-shadow: 1px 1px 4px rgba(0,0,0,0.2);
    }

    .section {
        padding: 80px 0;
    }

    .card {
        border: none;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.1);
        color: #000;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .card i {
        color: #ffd700;
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .workflow-step {
        background: rgba(255,255,255,0.1);
        border-radius: 1rem;
        padding: 30px;
        margin-bottom: 30px;
    }

    .testimonial {
        background: rgba(255,255,255,0.1);
        border-radius: 1rem;
        padding: 30px;
        margin-bottom: 30px;
    }

</style>

<!-- Hero Section -->
<div class="section text-center">
    <div class="container">
        <h1 class="display-4 mb-3">Welcome to {{ config('app.name', 'Lost & Found AI') }}</h1>
        <p class="lead mb-4">Quickly report and recover lost identification documents with AI-powered image recognition and OCR technology.</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Sign In</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg mx-2">Register</a>
    </div>
</div>

<!-- Features Section -->
<div class="section text-center">
    <div class="container">
        <h2 class="mb-5">Features</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="icon ni ni-file-text feature-icon"></i>
                        <h5 class="card-title mt-3">Report Lost IDs</h5>
                        <p class="card-text">Easily submit lost identification documents with images and detailed information for fast recovery.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="icon ni ni-search feature-icon"></i>
                        <h5 class="card-title mt-3">AI-Powered Matching</h5>
                        <p class="card-text">Our system uses OCR and AI image recognition to accurately match lost documents to their owners.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="icon ni ni-bell feature-icon"></i>
                        <h5 class="card-title mt-3">Instant Notifications</h5>
                        <p class="card-text">Receive real-time alerts when a lost document matching your report is found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="section bg-gradient">
    <div class="container">
        <h2 class="text-center mb-5">How It Works</h2>
        <div class="row">
            <div class="col-md-4 text-center shadow-sm">
                <div class="workflow-step">
                    <h3>Step 1</h3>
                    <p>Report your lost ID by uploading images and providing details about the lost document.</p>
                </div>
            </div>
            <div class="col-md-4 text-center shadow-sm">
                <div class="workflow-step">
                    <h3>Step 2</h3>
                    <p>Our AI system scans all reports and uses advanced image recognition to find potential matches.</p>
                </div>
            </div>
            <div class="col-md-4 text-center shadow-sm">
                <div class="workflow-step">
                    <h3>Step 3</h3>
                    <p>Receive instant notifications when a match is found and recover your lost document quickly.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="section">
    <div class="container">
        <h2 class="text-center mb-5">What Users Say</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial shadow-sm">
                    <p>"I lost my ID and found it within hours thanks to this system! Highly recommend." – Alice K.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial shadow-sm">
                    <p>"The AI matching is amazing. The system notified me as soon as my document was found." – John D.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial shadow-sm">
                    <p>"Simple to use and very effective. A must-have for anyone prone to losing important documents." – Mary W.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call To Action Section -->
<div class="section text-center">
    <div class="container">
        <h2>Get Started Today!</h2>
        <p class="mb-4">Sign up now and make recovering lost IDs effortless.</p>
        <a href="{{ route('register') }}" class="btn btn-success btn-lg mx-2">Create an Account</a>
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg mx-2">Sign In</a>
    </div>
</div>
@endsection
