<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Razorpay\Api\Api;


class CartController extends Controller
{
    public function addToCart($id)
{
    $product = Product::findOrFail($id);

    $cart = Cart::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->first();

    if ($cart) {

        $cart->increment('qty');

    } else {

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'qty' => 1
        ]);
    }

    return back()->with(
        'success',
        'Product Added To Cart Successfully'
    );
}

public function index()
{
     $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
  return view('cart.index', compact('cartItems'));
}

public function checkout()
{
    $cartItems = \App\Models\Cart::with('product')
                    ->where('user_id', auth()->id())
                    ->get();

    $razorpayKey = env('RAZORPAY_KEY');

    return view('checkout', compact(
        'cartItems',
        'razorpayKey'
    ));

    return view('checkout',compact('cartItems','total'));
}

 public function payment(Request $request)
    {
        return redirect()
        ->route('checkout')
        ->with('success', 'Payment Process Started');
    }


}
