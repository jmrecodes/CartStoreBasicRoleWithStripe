@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                {{-- Card styling will follow Bootstrap defaults, which align with minimalist principles --}}
                {{-- For specific card variants from 05_05_variants.md, custom classes could be added --}}
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{-- Spacing within card-body is handled by Bootstrap padding --}}
                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf

                        <div class="row mb-3">
                            {{-- Consistent spacing for form groups (mb-3) as per Bootstrap and layout guidelines --}}
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            {{-- Labels are correctly associated with inputs using 'for' attribute --}}

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                {{-- Form control styling from Bootstrap. Error state class 'is-invalid' as per 05_02_forms.md --}}

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{-- Error message display as per 05_02_forms.md --}}
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                {{-- Password input type --}}

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                {{-- Password confirmation input --}}
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{-- Primary button styling from Bootstrap as per 05_01_buttons.md --}}
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 