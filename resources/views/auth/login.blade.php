@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- Card styling by Bootstrap --}}
                <div class="card-header">{{ __('Sign In') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                {{-- Input styling by Bootstrap. Error state 'is-invalid' as per 05_02_forms.md --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {{-- Form check styling by Bootstrap --}}
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{-- Primary button styling by Bootstrap --}}
                                    {{ __('Sign In') }}
                                </button>

                                @if (Route::has('password.request'))
                                    {{-- We are not implementing password reset in this plan, but link could be here --}}
                                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a> --}}
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Basic Vanilla JS for client-side validation enhancements if needed.
    // For login, usually less complex client-side validation is required compared to registration.
    // Ensuring required fields are not empty can be done with HTML5 `required` attribute.
    // const loginForm = document.getElementById('loginForm');
    // if (loginForm) {
    //     loginForm.addEventListener('submit', function(event) {
    //         const email = document.getElementById('email').value;
    //         const password = document.getElementById('password').value;
    //         if (!email || !password) {
    //             // Basic check, though HTML5 `required` handles this better for accessibility
    //             // alert('Email and password are required.');
    //             // event.preventDefault();
    //         }
    //     });
    // }
</script>
@endsection 