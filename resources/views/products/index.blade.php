@extends('layouts.app')

@section('title', 'Our Products')

@section('styles')
<style>
.product-card {
    /* Uses default card shadow from app.blade.php */
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg) !important; /* Use shadow variable from design system */
}
.product-image {
    height: 200px; 
    object-fit: cover; 
    border-top-left-radius: var(--border-radius-md); /* Match card border radius */
    border-top-right-radius: var(--border-radius-md); /* Match card border radius */
}
</style>
@endsection

@section('content')
<div class="container mt-3"> {{-- mt-space-md to mt-3 --}}
    <div class="row mb-4"> {{-- mb-space-lg to mb-4 --}}
        <div class="col-12 text-center">
            <h1>Our Products</h1>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert"> {{-- mb-space-md to mb-3 --}}
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-3" role="alert"> {{-- mb-space-md to mb-3 --}}
            {{ session('error') }}
        </div>
    @endif

    @if($products->isEmpty())
        <div class="col-12 text-center mt-5"> {{-- mt-space-xl to mt-5 --}}
            <p class="lead">No products available at the moment. Please check back later!</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3"> {{-- g-space-md to g-3 (Bootstrap gap utility) --}}
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 product-card"> {{-- Removed shadow-sm to use default card shadow --}}
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        @else
                            <img src="https://placehold.co/600x400/EFEFEF/AAAAAA?text={{ urlencode($product->name) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text fs-5 fw-bold text-primary mb-2">${{ number_format($product->price, 2) }}</p> {{-- mb-space-sm to mb-2 --}}
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-0 pb-2 px-2"> {{-- pb-space-sm to pb-2, px-space-sm to px-2 --}}
                            @auth
                                @if(!Auth::user()->isAdmin()) 
                                    <form action="{{ route('cart.store') }}" method="POST" class="d-grid"> {{-- Use d-grid for full-width button in form --}}
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success">Add to Cart</button> {{-- Removed w-100, d-grid handles width --}}
                                    </form>
                                @else
                                    <p class="text-muted text-center small mb-0">Admin view: Cannot add to cart.</p>
                                @endif
                            @else
                                <div class="d-grid"> {{-- Use d-grid for full-width button --}}
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Purchase</a> {{-- Removed w-100 --}}
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-between flex-column mt-5"> {{-- mt-space-lg to mt-4 --}}
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection 