@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <h1>{{ __('Our Products') }}</h1>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $product->image_url ?: 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                        <h6 class="card-subtitle mb-2 fw-bold">${{ number_format($product->price, 2) }}</h6>
                        <div class="mt-auto">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Add to Cart') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    {{ __('No products found at this time.') }}
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center flex-column mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-img-top {
        border-bottom: 1px solid #eee;
    }
    /* Ensure consistent button height even if text wraps (though w-100 helps) */
    .card .btn {
        min-height: 38px; /* Adjust as needed */
    }
</style>
@endpush 