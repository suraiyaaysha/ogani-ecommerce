<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Coupon;

class CartController extends Controller
{

    public function cartList()
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        $cartItems = Cart::getContent();

        $couponMessage = session('success');

        // Recalculate the subtotal and total after applying the coupon
        $subtotal = Cart::getSubTotal();
        $total = Cart::getTotal();

        return view('frontend.shop.cart', compact('cartItems', 'couponMessage', 'subtotal', 'total'));
    }

    public function addToCart(Request $request)
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'featured_image' => $request->featured_image,
            ]
        ]);

        session()->flash('success', 'Product is added to the cart successfully!');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is updated successfully!');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        Cart::remove($request->id);
        session()->flash('success', 'Item Cart is removed successfully!');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        Cart::clear();

        session()->flash('success', 'All Cart items cleared successfully!');

        return redirect()->route('cart.list');
    }

    public function applyCoupon(Request $request)
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if ($coupon) {
            $cartItems = Cart::getContent();

            $subtotal = Cart::getSubTotal();
            $discountAmount = $coupon->discount;
            // $discount = $subtotal * ($coupon->discount / 100);
            $discount = $subtotal * ($discountAmount / 100);
            $total = $subtotal - $discount;

            // Update the total price in the cart session
            session()->put('total', $total);

            return redirect()->route('cart.list')->with([
                'success' => 'Coupon applied successfully.',
                'total' => $total,
                'discount' => $discount,
                'discountAmount' => $discountAmount,
            ]);
        }

        return redirect()->route('cart.list')->with('error', 'Invalid coupon code.')->with('coupon_error', true);
    }

}
