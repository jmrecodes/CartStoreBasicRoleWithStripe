@extends('layouts.app')

@section('title', 'Create New Product')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header fw-bold">{{ __('Create New Product') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}">
                        @include('admin.products._form', ['submitButtonText' => 'Create Product'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 