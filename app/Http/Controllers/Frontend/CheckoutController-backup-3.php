<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BillingDetails;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session;
// use Stripe\Charge;
// use Stripe\Customer;
// use Stripe\Exception\CardException;

class CheckoutController extends Controller
{
    public function index()
    {
        // Set the session ID for the cart
        $sessionKey = auth()->id();
        session()->setId($sessionKey);
        Cart::session($sessionKey);

        $cartItems = Cart::getContent();
        $couponMessage = session('success');

        // Retrieve the updated total amount from the session
        $subtotal = Cart::getSubTotal();
        $total = session('total', Cart::getTotal());

        // Get the authenticated user's details
        $user = User::find(Auth::id());

         // Get the authenticated user's billing details
        // $billingDetails = BillingDetails::where('user_id', Auth::id())->first();

        return view('frontend.checkout.index', compact('cartItems', 'couponMessage', 'subtotal', 'total', 'user'));
    }

    public function store(Request $request)
    {
        // Set the session ID for the cart
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

        // Get the authenticated user's details
        $userInfo = User::find(Auth::id());

        // Get the selected payment method
        $paymentMethod = $request->payment_method;

        // Create a new order
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $userInfo->first_name,
            'last_name' => $userInfo->last_name,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'payment_method' => $paymentMethod,
            'order_number' => Str::uuid()->toString(),
            'payment_status' => 'pending',
            'grand_total' => Cart::getTotal(),
            'item_count' => Cart::getContent()->count(),
        ]);


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


        // Create or update the user's billing details
        $billingDetails = BillingDetails::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'user_id' => Auth::id(), // Set the user_id field to the authenticated user's ID
                'order_id' => $order->id, // Set the order_id field to the newly created order's ID
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        // Update the user's details
        $userInfo->userDetails()->update([
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);


        // Redirect to the order confirmation page
        if ($paymentMethod === 'cash_on_delivery') {

            return redirect()->route('orders.show', $order);

        } elseif ($paymentMethod === 'stripe') {
            // Stripe payment

            return redirect()->route('orders.show', $order);
        }

    }

    // public function createSession()
    // {
    //     // Set the session ID for the cart
    //     $sessionKey = auth()->id();
    //     session()->setId($sessionKey);
    //     Cart::session($sessionKey);

    //     // Set the Stripe API key
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     // Retrieve cart items
    //     $cartItems = Cart::getContent();

    //     // Prepare line items for Stripe session
    //     $lineItems = [];

    //     foreach ($cartItems as $item) {
    //         $lineItems[] = [
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'unit_amount' => $item->price * 100, // Stripe expects the amount in cents
    //                 'product_data' => [
    //                     'name' => $item->name,
    //                     'description' => $item->description,
    //                     'images' => [$item->image_url],
    //                 ],
    //             ],
    //             'quantity' => $item->quantity,
    //         ];
    //     }

    //     try {
    //         // Create a new Stripe session
    //         $session = \Stripe\Checkout\Session::create([
    //             'payment_method_types' => ['card'],
    //             'line_items' => $lineItems,
    //             'mode' => 'payment',
    //             'success_url' => route('orders.show', ['order' => 'ORDER_ID']), // Replace 'ORDER_ID' with the actual order ID in the URL
    //             'cancel_url' => route('checkout.index'),
    //         ]);

    //         // Return the session ID to the client
    //         return response()->json(['sessionId' => $session->id]);
    //     } catch (\Exception $e) {
    //         // Handle errors that occur during session creation
    //         return response()->json(['error' => 'Failed to create session'], 500);
    //     }
    // }

    public function applyCoupon(Request $request)
    {
        // Set the session ID for the cart
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
                    'total' => $total,
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
}
