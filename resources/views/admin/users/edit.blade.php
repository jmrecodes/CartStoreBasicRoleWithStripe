@extends('layouts.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header fw-bold">Edit User: <span class="fw-normal">{{ $user->name }}</span></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @method('PUT')
                        @include('admin.users._form', ['user' => $user, 'submitButtonText' => 'Update User'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 