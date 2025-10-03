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
                    <h5 class="nk-block-title">Sign-In</h5>
                    <div class="nk-block-des">
                        <p>Access your account using your email and password.</p>
                    </div>
                </div>
            </div>

            {{-- Laravel Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email">Email</label>
                        <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                    </div>
                    <div class="form-control-wrap">
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Enter your email" required autofocus>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">Password</label>
                        <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                    <div class="form-control-wrap">
                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                            data-target="password">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" name="password" id="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Enter your password" required>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="form-group">
                    <div class="custom-control custom-control-sm custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </form>

            <div class="form-note-s2 pt-4">
                New on our platform? <a href="{{ route('register') }}">Create an account</a>
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
                            <h4>AI Lost & Found</h4>
                            <p>Quickly match and recover lost IDs using AI and OCR technology.</p>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="{{ asset('images/slides/promo-b.png') }}" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Fast & Secure</h4>
                            <p>Ensure your sensitive information stays safe and recoverable.</p>
                        </div>
                    </div>
                </div>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="{{ asset('images/slides/promo-c.png') }}" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Smart Recovery</h4>
                            <p>Powered by AI to connect lost items with rightful owners efficiently.</p>
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
