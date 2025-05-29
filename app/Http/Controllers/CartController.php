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
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $userId = Auth::id();

        Cart::query()->firstOrCreateWithStoreItems(
            item: $product,
            userId: $userId
        );

        return redirect()->route('home')->with('success', __(':name added to cart!', ['name' => $product->name]));
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

        $cartTotal = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                if ($item->itemable) {
                    $cartTotal += $item->itemable->getPrice();
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
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        $userId = Auth::id();
        $cart = Cart::query()->where('user_id', $userId)->first();
        $cartItemId = $request->input('cart_item_id');

        if ($cart) {
            // Find the specific item within the user's cart to ensure they own it
            $cartItem = $cart->items()->where('id', $cartItemId)->first();

            if ($cartItem && $cartItem->itemable) {
                $productToRemove = Product::findOrFail($cartItemId);
                $cart->removeItem($cartItem->itemable);
                return redirect()->route('cart.index')->with('success', __(':name removed from cart.', ['name' => $cartItem->itemable->name]));
            } else {
                return redirect()->route('cart.index')->with('error', __('Cart item not found or product data missing.'));
            }
        } else {
            return redirect()->route('cart.index')->with('error', __('Cart not found.'));
        }
    }
}
