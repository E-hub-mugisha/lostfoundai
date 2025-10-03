@extends('layouts.guest')

@section('content')
<div class="nk-split nk-split-page nk-split-lg">
    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
        <div class="absolute-top-right d-lg-none p-3 p-sm-5">
            <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo">
                <em class="icon ni ni-info"></em>
            </a>
        </div>

        <div class="nk-block nk-block-middle nk-auth-body">
            
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Create an Account</h5>
                    <div class="nk-block-des">
                        <p>Join the Lost & Found platform and recover your documents easily.</p>
                    </div>
                </div>
            </div>

            {{-- Laravel Register Form --}}
            <form method="POST" action="{{ route('register') }}" class="form-validate is-alter" autocomplete="off">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="name">Full Name</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="Enter your full name" required autofocus>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Enter your email" required>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="form-control-wrap">
                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                            data-target="password">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" name="password" id="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Enter a strong password" required>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control form-control-lg"
                            placeholder="Re-enter your password" required>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
                </div>
            </form>

            <div class="form-note-s2 pt-4">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>

        <div class="nk-block nk-auth-footer">
            <div class="nk-block-between">
                <ul class="nav nav-sm">
                    <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Terms & Condition</a></li>
                    <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Privacy Policy</a></li>
                    <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Help</a></li>
                </ul>
            </div>
            <div class="mt-3">
                <p>&copy; {{ date('Y') }} Lost & Found. All Rights Reserved.</p>
            </div>
        </div>
    </div>

    {{-- Right-side Promo Slider --}}
    <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
        data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
        <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
            <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="{{ asset('images/slides/promo-a.png') }}" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Smart Registration</h4>
                            <p>Join the AI-powered Lost & Found system to protect your documents.</p>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="{{ asset('images/slides/promo-b.png') }}" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Secure Accounts</h4>
                            <p>Keep your information safe with advanced authentication.</p>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="{{ asset('images/slides/promo-c.png') }}" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Faster Recovery</h4>
                            <p>Register today and make it easier to recover lost IDs quickly.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-dots"></div>
            <div class="slider-arrows"></div>
        </div>
    </div>
</div>
@endsection
