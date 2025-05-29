@extends('layouts.app')

@section('title', 'Create New User')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header fw-bold">{{ __('Create New User') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @include('admin.users._form', ['submitButtonText' => 'Create User'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 