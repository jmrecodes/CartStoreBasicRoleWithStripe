@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header">{{ __('My Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('Name') }}:</strong></label>
                        <p class="form-control-plaintext ps-1">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('Email Address') }}:</strong></label>
                        <p class="form-control-plaintext ps-1">{{ $user->email }}</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-start">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">
                            {{ __('Edit Profile') }}
                        </a>
                        <a href="{{ route('profile.change-password.form') }}" class="btn btn-secondary">
                            {{ __('Change Password') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 