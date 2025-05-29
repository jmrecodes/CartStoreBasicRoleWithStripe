@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>{{ __('Name') }}:</strong></label>
                        <p id="name" class="form-control-plaintext">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>{{ __('Email Address') }}:</strong></label>
                        <p id="email" class="form-control-plaintext">{{ $user->email }}</p>
                    </div>

                    <hr>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
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
@endsection 