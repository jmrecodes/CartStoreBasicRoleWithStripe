<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public int $count = 0;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            $cart = Cart::query()->with('items') // Eager load items and their associated product model
            ->where('user_id', Auth::id())
            ->first();

            $this->count = $cart ? $cart->items->count() : 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-count');
    }
}
