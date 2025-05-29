@extends('layouts.app')

@section('title', 'Your Shopping Cart')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Your Shopping Cart</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($cart && $cart->items->isNotEmpty())
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 10%; padding-left: var(--space-md);">Image</th>
                            <th scope="col" style="width: 45%;">Product</th>
                            <th scope="col" style="width: 15%;" class="text-end">Price</th>
                            <th scope="col" style="width: 15%;" class="text-center pe-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            @if ($item->itemable)
                                <tr>
                                    <td style="padding-left: var(--space-md);">
                                        <img src="{{ $item->itemable->image_url ?: 'https://placehold.co/100x100/EFEFEF/AAAAAA?text=No+Image' }}" 
                                             alt="{{ $item->itemable->name }}" class="img-fluid rounded" style="max-height: 75px; width: 75px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $item->itemable->name }}</strong>
                                        <p class="small text-muted mb-0">{{ Str::limit($item->itemable->description, 60) }}</p>
                                    </td>
                                    <td class="text-end">${{ number_format($item->itemable->getPrice(), 2) }}</td>
                                    <td class="text-center pe-3">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light py-2 px-3">
                <div class="row justify-content-end align-items-center">
                    <div class="col-md-auto">
                        <span class="text-muted me-2">Total:</span>
                        <span class="fs-5 fw-bold text-primary">${{ number_format($cartTotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('purchase') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ number_format($cartTotal, 2) }}">


            <div class="row mt-4 mb-5 justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Cardholder Name</label>
                                <input id="card-holder-name" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card Details</label>
                                <div id="card-element" class="form-control p-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 mb-5 align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100 w-md-auto"> Continue Shopping</a>
                </div>
                <div class="col-md-6 text-md-end">
                    <button type="button" id="card-button" class="btn btn-primary btn-lg w-100 w-md-auto">Proceed to Checkout</button>
                </div>
            </div>
        </form>
    @else
        <div class="text-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cart-x mb-3 text-muted" viewBox="0 0 16 16">
                <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 1 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>
                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            <h4>Your cart is empty.</h4>
            <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
    @endif
</div>
@endsection

<script src="https://js.stripe.com/v3/"></script>

<script>
    // On page load, create a Stripe client
    document.addEventListener('DOMContentLoaded', function() {
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        // when mount is complete, add an event listener to the card element
        cardElement.addEventListener('change', (e) => {
            // if the card number input was changed, check if the card number is valid
            if (e.elementType === 'card') {
                if (e.complete) {
                    cardButton.classList.remove('disabled');
                } else {
                    cardButton.classList.add('disabled');
                }
            }
        });

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const form = cardButton.closest('form'); // Get the form element

        // verify the card details before proceeding to checkout
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault(); // Prevent default form submission

            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                alert("Invalid card details: " + error.message); // Provide more specific error
                cardButton.classList.add('disabled');
            } else {
                // Create a hidden input to store the paymentMethod.id
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethodId');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    });
</script>