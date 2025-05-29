@extends('layouts.app')

@section('title', 'Manage Products')

@section('styles')
<style>
    .product-thumbnail {
        max-width: 60px;
        max-height: 60px;
        object-fit: cover;
        border-radius: var(--border-radius-sm);
    }
</style>
@endsection

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Product Management</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Add New Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">ID</th>
                            <th scope="col" style="width: 80px;">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Price</th>
                            <th scope="col" class="text-center pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="ps-3">{{ $product->id }}</td>
                                <td>
                                    @if ($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-thumbnail">
                                    @else
                                        <img src="https://placehold.co/100x100/EFEFEF/AAAAAA?text=No+Img" alt="No image" class="product-thumbnail bg-light">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td class="text-end">${{ number_format($product->price, 2) }}</td>
                                <td class="text-center pe-3">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary btn-xs me-1" title="Edit Product">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete the product \'{{ $product->name }}\'? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-xs" title="Delete Product">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.528ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Zm3.5.5a.5.5 0 0 0-.528-.47l-.5 8.5a.5.5 0 0 0 .998.06l.5-8.5a.5.5 0 0 0-.47-.528Z"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($products->hasPages())
            <div class="card-footer bg-light py-2 px-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 