<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;

use Darryldecode\Cart\Facades\CartFacade as Cart;
// use Darryldecode\Cart\Facades\Cart;

use Illuminate\Support\Facades\Auth;
// use Darryldecode\Cart\CartCondition;

use App\Models\User;

use Stripe\Stripe;
use Stripe\PaymentIntent;


class CheckoutController extends Controller
{
    // public function index()
    // {
    //     $sessionKey = auth()->id();
    //     session()->setId($sessionKey);
    //     Cart::session($sessionKey);

    //     // $cartItems = Cart::getContent();
    //     // $subtotal = Cart::getSubTotal();
    //     // $total = Cart::getTotal();

    //     $cartItems = Cart::getContent();

    //     $couponMessage = session('success');

    //     // Recalculate the subtotal and total after applying the coupon
    //     $subtotal = Cart::getSubTotal();
    //     $total = Cart::getTotal();


    //     return view('frontend.checkout.index', compact('cartItems', 'couponMessage', 'subtotal', 'total'));
    // }

    public function index()
    {
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        $cartItems = Cart::getContent();
        $couponMessage = session('success');

        // Retrieve the updated total amount from the session
        $subtotal = Cart::getSubTotal();
        $total = session('total', Cart::getTotal());

        return view('frontend.checkout.index', compact('cartItems', 'couponMessage', 'subtotal', 'total'));
    }


    // public function store(Request $request)
    // {
    //     $sessionKey = auth()->id();
    //     session()->setId($sessionKey);
    //     Cart::session($sessionKey);

    //     // Validate the form data
    //     $request->validate([
    //         'address_1' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'zip' => 'required',
    //         'country' => 'required',
    //         'phone' => 'required',
    //         'payment_method' => 'required',
    //     ]);

    //     // Get the authenticated user's datails
    //     $userInfo = User::where('id', Auth::id())->first();


    //     // Get the selected payment method
    //     $paymentMethod = $request->payment_method;

    //     // Create a new order
    //     $order = Order::create([
    //         'user_id' => Auth::id(),
    //         'first_name' => $userInfo->first_name, //Set the first_name from user details
    //         'last_name' => $userInfo->last_name, //Set the last_name from user details
    //         'address_1' => $request->address_1,
    //         'address_2' => $request->address_2,
    //         'city' => $request->city,
    //         'state' => $request->state,
    //         'zip' => $request->zip,
    //         'country' => $request->country,
    //         'phone' => $request->phone,
    //         // 'payment_method' => $request->payment_method,
    //         'payment_method' => $paymentMethod,

    //         'order_number' => Str::uuid()->toString(), // Generate a unique order number

    //         'payment_status' => 'pending',  // Set the initial payment status to "pending"
    //         'grand_total' => Cart::getTotal(),
    //         'item_count' => Cart::getContent()->count(),
    //     ]);

    //     // Move cart items to order items
    //     $cartItems = Cart::getContent();

    //     foreach($cartItems as $cartItem) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $cartItem->id,
    //             'quantity' => $cartItem->quantity,
    //             'price' => $cartItem->price,
    //         ]);
    //     }

    //     // Clear the user's cart
    //     Cart::clear();

    //     // For Payment method
    //     // Perform payment based on the selected payment method
    //         if ($request->payment_method === 'cash_on_delivery') {
    //             // Update the payment status to "paid" for cash on delivery
    //             $order->update(['payment_status' => 'paid']);

    //             // Redirect to the order confirmation page
    //             return redirect()->route('orders.show', $order);
    //         } elseif ($request->payment_method === 'stripe') {
    //             // Stripe payment logic
    //             // Make sure you have the necessary Stripe API keys set in your .env file

    //             Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    //             $intent = PaymentIntent::create([
    //                 // 'amount' => Cart::getTotal() * 100,
    //                 'amount' => Cart::getTotal(),
    //                 'currency' => 'usd',
    //             ]);

    //             // Store the Stripe payment intent ID in the order
    //             $order->stripe_payment_intent_id = $intent->id;
    //             $order->save();

    //             // Redirect the user to the Stripe payment page or perform the necessary actions
    //             // to handle the payment using Stripe API
    //             return redirect()->route('stripe.payment', ['order_id' => $order->id]);
    //         }
    //         // For Payment method

    //     // Redirect to the order confirmation page
    //     return redirect()->route('orders.show', $order);

    // }

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


        // Get the selected payment method
        $paymentMethod = $request->payment_method;

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
            // 'payment_method' => $request->payment_method,
            'payment_method' => $paymentMethod,

            'order_number' => Str::uuid()->toString(), // Generate a unique order number

            'payment_status' => 'pending',  // Set the initial payment status to "pending"
            'grand_total' => Cart::getTotal(),
            'item_count' => Cart::getContent()->count(),
        ]);

    // For Payment method
    // Perform payment based on the selected payment method
    if ($request->payment_method === 'cash_on_delivery') {
        // Update the payment status to "paid" for cash on delivery
        $order->update(['payment_status' => 'paid']);

        // Move cart items to order items
        $cartItems = Cart::getContent();

        foreach ($cartItems as $cartItem) {
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
    } elseif ($request->payment_method === 'stripe') {
        // Stripe payment logic
        // Make sure you have the necessary Stripe API keys set in your .env file

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $intent = PaymentIntent::create([
            'amount' => Cart::getTotal() * 100,
            // 'amount' => Cart::getTotal(),
            'currency' => 'usd',
        ]);

        // Store the Stripe payment intent ID in the order
        $order->stripe_payment_intent_id = $intent->id;
        $order->save();

        // Move cart items to order items
        $cartItems = Cart::getContent();

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }

        // Clear the user's cart
        Cart::clear();

        // Redirect the user to the Stripe payment page or perform the necessary actions
        // to handle the payment using Stripe API
        return redirect()->route('stripe.payment', ['order_id' => $order->id]);
    }
    // For Payment method

    // Redirect to the order confirmation page
    return redirect()->route('orders.show', $order);
}



    // public function applyCoupon(Request $request)
    // {
    //     $sessionKey = auth()->id();
    //     session()->setId($sessionKey);
    //     Cart::session($sessionKey);

    //     $couponCode = $request->input('coupon_code');
    //     $coupon = Coupon::where('coupon_code', $couponCode)->first();

    //     if ($coupon) {
    //         $cartItems = Cart::getContent();
    //         $subtotal = Cart::getSubTotal();
    //         $discountAmount = $coupon->discount;
    //         $discount = $subtotal * ($discountAmount / 100);
    //         $total = $subtotal - $discount;

    //         Cart::session($sessionKey)->condition($couponCode, $discount, new CartCondition([
    //             'name' => $couponCode,
    //             'type' => 'coupon',
    //             'value' => $discount,
    //         ]));

    //         return redirect()->route('checkout.index')->with([
    //             'success' => 'Coupon applied successfully.',
    //             'total' => $total,
    //             'discount' => $discount,
    //             'discountAmount' => $discountAmount,
    //         ]);
    //     }

    //     return redirect()->route('checkout.index')->with('error', 'Invalid coupon code.')->with('coupon_error', true);
    // }

// public function applyCoupon(Request $request)
// {
//     $sessionKey = auth()->id();
//     session()->setId($sessionKey);
//     Cart::session($sessionKey);

//     $couponCode = $request->input('coupon_code');
//     $coupon = Coupon::where('coupon_code', $couponCode)->first();

//     if ($coupon) {
//         $cartItems = Cart::getContent();

//         $subtotal = Cart::getSubTotal();
//         $discountAmount = $coupon->discount;
//         $discount = $subtotal * ($discountAmount / 100);
//         $total = $subtotal - $discount;

//         foreach ($cartItems as $item) {
//             Cart::session($sessionKey)->update($item->id, [
//                 'total' => $total
//             ]);
//         }

//         // Store the updated total in the session
//         session(['total' => $total]);

//         return redirect()->route('checkout.index')->with([
//             'success' => 'Coupon applied successfully.',
//             'total' => $total,
//             'discount' => $discount,
//             'discountAmount' => $discountAmount,
//         ]);
//     }

//     return redirect()->route('checkout.index')->with('error', 'Invalid coupon code.')->with('coupon_error', true);
// }

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

            // Update the cart total
            foreach ($cartItems as $item) {
                Cart::session($sessionKey)->update($item->id, [
                    'total' => $total
                ]);
            }

            // Store the updated total in the session
            session(['total' => $total]);

            // Update the order total if it exists
            $orderId = session('orderId');
            if ($orderId) {
                $order = Order::find($orderId);
                if ($order) {
                    $order->grand_total = $total;
                    $order->save();
                }
            }

            return redirect()->route('checkout.index')->with([
                'success' => 'Coupon applied successfully.',
                'total' => $total,
                'discount' => $discount,
                'discountAmount' => $discountAmount,
            ]);
        }

        return redirect()->route('checkout.index')->with('error', 'Invalid coupon code.')->with('coupon_error', true);
    }

    // Stripe payment
    // public function stripePayment($orderId)
    // {
    //     $order = Order::findOrFail($orderId);

    //     return view('frontend.checkout.stripe', compact('order'));
    // }

    // public function stripePaymentIntent($orderId)
    // {
    //     $order = Order::findOrFail($orderId);

    //     Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    //     $intent = PaymentIntent::retrieve($order->stripe_payment_intent_id);

    //     return response()->json(['client_secret' => $intent->client_secret]);
    // }


    // app/Http/Controllers/Frontend/CheckoutController.php



public function stripePayment($orderId)
{
    $order = Order::findOrFail($orderId);

    // Set your Stripe API key
    Stripe::setApiKey(config('services.stripe.secret'));

    // Create a PaymentIntent
    $paymentIntent = PaymentIntent::create([
        'amount' => $order->grand_total * 100, // Stripe requires the amount in cents
        'currency' => 'usd', // Replace with your desired currency
    ]);

    // Store the PaymentIntent ID in the order
    $order->update(['payment_intent_id' => $paymentIntent->id]);

    // Redirect the user to the Stripe payment page
    return view('frontend.stripe.payment')->with([
        'clientSecret' => $paymentIntent->client_secret,
        'order' => $order,
    ]);
}

public function confirmStripePayment($orderId)
{
    $order = Order::findOrFail($orderId);

    // Set your Stripe API key
    Stripe::setApiKey('sk_test_51NI8spHyixi4P8fSmMZalkWSV0frXor2xZZOUGM5NhCtBLXB0UBuowsQRUIY37SWqstNBaODAQaNB8zP69K8quZI00DbkqE5ll');

    // Retrieve the payment method from the request
    $paymentMethodId = request('payment_method');

    // Confirm the payment intent with the payment method
    $paymentIntent = PaymentIntent::update(
        $order->payment_intent_id,
        [
            'payment_method' => $paymentMethodId,
        ]
    );

    if ($paymentIntent->status === 'succeeded') {
        // Update the payment status to "paid" or any other appropriate status for Stripe payments
        $order->update(['payment_status' => 'paid']);

        // Redirect to the order confirmation page
        return redirect()->route('orders.show', $order);
    } else {
        // Display an error message to the user
        return back()->with('error', 'Payment confirmation failed. Please try again.');
    }
}




}
