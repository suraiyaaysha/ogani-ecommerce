<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
// use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;


use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        $cartItems = Cart::getContent();
        $subtotal = Cart::getSubTotal();
        $total = Cart::getTotal();

        return view('frontend.checkout.index', compact('cartItems', 'subtotal', 'total'));
    }

    public function store(Request $request)
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        // Validate the form data
        $request->validate([
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'payment_method' => 'required',
        ]);

        // Get the authenticated user's datails
        $userInfo = User::where('id', Auth::id())->first();

        // Create a new order
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $userInfo->first_name, //Set the first_name from user details
            'last_name' => $userInfo->last_name, //Set the last_name from user details
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,

            'order_number' => Str::uuid()->toString(), // Generate a unique order number

            'status' => 'pending',
            'grand_total' => Cart::getTotal(),
            'item_count' => Cart::getContent()->count(),
        ]);

        // Move cart items to order items
        $cartItems = Cart::getContent();

        foreach($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }

        // Clear the user's cart
        Cart::clear();

        // Redirect to the order confirmation page
        return redirect()->route('orders.show', $order);

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
            $discount = $subtotal * ($discountAmount / 100);
            $total = $subtotal - $discount;

            Cart::session($sessionKey)->condition($couponCode, new CartCondition([
                'name' => $couponCode,
                'type' => 'coupon',
                'value' => abs((float)$discount),
            ]));

            return redirect()->route('checkout.index')->with([
                'success' => 'Coupon applied successfully.',
                'total' => $total,
                'discount' => $discount,
                'discountAmount' => $discountAmount,
            ]);
        }

        return redirect()->route('checkout.index')->with('error', 'Invalid coupon code.')->with('coupon_error', true);
    }
}

