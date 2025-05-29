<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            // Add quantity validation if you allow users to specify quantity on add
            // 'quantity' => 'sometimes|integer|min:1' 
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $quantity = $request->input('quantity', 1); // Default to 1 if not provided
        $userId = Auth::id();

        if (!$userId) {
            // This should ideally be caught by the 'auth' middleware on the route
            // but as a fallback:
            return redirect()->route('login')->with('error', __('You must be logged in to add items to the cart.'));
        }

        Cart::query()->firstOrCreateWithStoreItems(
            item: $product,
            quantity: $quantity,
            userId: $userId
        );

        return redirect()->route('home')->with('status', __(':name added to cart!', ['name' => $product->name]));
    }

    /**
     * Display the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $cart = Cart::query()->with('items', 'items.itemable') // Eager load items and their associated product model
                         ->where('user_id', $userId)
                         ->first();

        // Calculate total if the package doesn't do it automatically or if we need to display it this way
        $cartTotal = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                // Assuming itemable is the Product model and has a price attribute
                // And item has a quantity attribute
                if ($item->itemable) { // Check if itemable relationship is loaded and exists
                    $cartTotal += $item->itemable->getPrice() * $item->quantity;
                }
            }
        }
        
        return view('cart.index', compact('cart', 'cartTotal'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id', // Assuming your cart items table is 'cart_items'
        ]);

        $userId = Auth::id();
        $cart = Cart::query()->where('user_id', $userId)->first();
        $cartItemId = $request->input('cart_item_id');

        if ($cart) {
            // Find the specific item within the user's cart to ensure they own it
            $cartItem = $cart->items()->where('id', $cartItemId)->first();
            
            if ($cartItem && $cartItem->itemable) { // itemable is the product
                // The documentation shows $cart->removeItem($productModel)
                // We need to pass the actual product model instance that this cartItem refers to.
                $productToRemove = $cartItem->itemable;
                $cart->removeItem($productToRemove);
                return redirect()->route('cart.index')->with('status', __(':name removed from cart.', ['name' => $productToRemove->name]));
            } else {
                return redirect()->route('cart.index')->with('error', __('Cart item not found or product data missing.'));
            }
        } else {
            return redirect()->route('cart.index')->with('error', __('Cart not found.'));
        }
    }
}
