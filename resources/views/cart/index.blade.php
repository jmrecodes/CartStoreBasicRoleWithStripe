@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <h1>{{ __('Your Shopping Cart') }}</h1>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($cart && $cart->items->isNotEmpty())
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 10%;">{{ __('Image') }}</th>
                            <th>{{ __('Product') }}</th>
                            {{-- <th class="text-center" style="width: 10%;">{{ __('Quantity') }}</th> --}} {{-- Removed Quantity Header --}}
                            <th class="text-end" style="width: 15%;">{{ __('Price') }}</th>
                            <th class="text-end" style="width: 15%;">{{ __('Subtotal') }}</th>
                            <th class="text-center" style="width: 10%;">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            @if ($item->itemable) {{-- Check if product data is loaded --}}
                                <tr>
                                    <td>
                                        <img src="{{ $item->itemable->image_url ?: 'https://placehold.co/100x75/EFEFEF/AAAAAA?text=No+Image' }}" 
                                             alt="{{ $item->itemable->name }}" class="img-fluid rounded" style="max-height: 75px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $item->itemable->name }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($item->itemable->description, 50) }}</small>
                                    </td>
                                    {{-- <td class="text-center">{{ $item->quantity }}</td> --}} {{-- Removed Quantity Cell --}}
                                    <td class="text-end">${{ number_format($item->itemable->getPrice(), 2) }}</td>
                                    <td class="text-end">${{ number_format($item->itemable->getPrice() * $item->quantity, 2) }}</td> {{-- Subtotal still uses quantity --}}
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>{{ __('Total') }}</strong></td> {{-- Adjusted colspan --}}
                            <td class="text-end fw-bold h5">${{ number_format($cartTotal, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Continue Shopping') }}</a>
            {{-- <a href="#" class="btn btn-primary">{{ __('Proceed to Checkout') }}</a> --}} {{-- Placeholder for checkout --}}
        </div>

    @else
        <div class="alert alert-info text-center" role="alert">
            <h4 class="alert-heading">{{ __('Your cart is empty!') }}</h4>
            <p>{{ __('Looks like you haven\'t added any products to your cart yet.') }}</p>
            <hr>
            <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Browse Products') }}</a>
        </div>
    @endif
</div>
@endsection
