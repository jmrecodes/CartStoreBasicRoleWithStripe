@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
        @endif

                    @if (Auth::check())
                        {{ __('You are logged in!') }}
                    @else
                        {{ __('You are a guest!') }}
            @endif
                </div>
                </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Optional: Custom styles for the welcome page if needed */
    .card-header h4 {
        margin-bottom: 0; /* Adjust header spacing if needed */
    }
</style>
@endpush
