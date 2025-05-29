<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Binafy\LaravelCart\Models\Cart;

class PurchaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'paymentMethodId' => 'required',
            'total' => 'required',
        ]);

        try {
            $stripeCharge = $request->user()->charge(
                (int) ($request->total * 100), $request->paymentMethodId,
                ['return_url' => route('cart.index')]
            );

            Cart::where('user_id', $request->user()->id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment failed');
        }

        return redirect()->route('cart.index')->with('success', 'Payment successful');
    }
}
