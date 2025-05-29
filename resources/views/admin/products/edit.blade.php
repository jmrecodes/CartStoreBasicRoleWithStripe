@extends('layouts.app')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header fw-bold">Edit Product: <span class="fw-normal">{{ $product->name }}</span></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.update', $product) }}">
                        @method('PUT')
                        @include('admin.products._form', ['product' => $product, 'submitButtonText' => 'Update Product'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 