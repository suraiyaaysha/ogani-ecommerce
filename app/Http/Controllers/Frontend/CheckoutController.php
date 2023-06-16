<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BillingDetails;
use App\Models\ShippingDetails;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use Stripe\Stripe;
// use Illuminate\Support\Facades\Session;
// use Stripe\Charge;
// use Stripe\Customer;
// use Stripe\Exception\CardException;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Redirect to the order confirmation page
        if ($paymentMethod === 'cash_on_delivery') {

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

            /*--------------------------------------------------------------------------
            | User Billing and Shipping details Form Information Start
            |--------------------------------------------------------------------------*/

            // Update the user's details
            $userInfo->userDetails()->update([
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]);

            // Retrieve the user's billing details
            $billingDetails = BillingDetails::where('user_id', Auth::id())->first();

            if ($billingDetails) {
                // Billing details exist, update them
                $billingDetails->update([
                    'order_id' => $order->id,
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                ]);
            } else {
                // Billing details don't exist, create a new record
                $billingDetails = BillingDetails::create([
                    'user_id' => Auth::id(),
                    'order_id' => $order->id,
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                ]);
            }

            // Check if the "Ship to a different address?" checkbox is checked
            $shipToDifferentAddress = $request->has('ship_to_different_address');

            // Retrieve the user's billing details
            $billingDetails = BillingDetails::where('user_id', Auth::id())->first();

            if ($shipToDifferentAddress) {
                // Ship to a different address
                // Update or create shipping details
                $shippingDetails = ShippingDetails::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'order_id' => $order->id,
                        'address_1' => $request->shipping_address_1,
                        'address_2' => $request->shipping_address_2,
                        'city' => $request->shipping_city,
                        'state' => $request->shipping_state,
                        'zip' => $request->shipping_zip,
                        // 'country' => $request->shipping_country,
                        'phone' => $request->shipping_phone,
                    ]
                );
            } else {
                // Use billing details as shipping details
                $shippingDetails = ShippingDetails::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'order_id' => $order->id,
                        'address_1' => $billingDetails->address_1,
                        'address_2' => $billingDetails->address_2,
                        'city' => $billingDetails->city,
                        'state' => $billingDetails->state,
                        'zip' => $billingDetails->zip,
                        // 'country' => $billingDetails->country,
                        'phone' => $billingDetails->phone,
                    ]
                );
            }

            /*--------------------------------------------------------------------------
            | User Billing and Shipping details Form Information End
            |--------------------------------------------------------------------------*/

            // Redirect or show a success message to the user
            // return redirect()->route('order.success', $order->order_number);
            return redirect()->route('orders.show', $order);

        } elseif ($paymentMethod === 'stripe') {

            // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            // Move cart items to order items
            $cartItems = Cart::getContent();

            $lineItems = [];

            foreach ($cartItems as $cartItem) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $cartItem->name,
                            // 'images' => [$cartItem->featured_image],
                        ],
                        'unit_amount' => $cartItem->price * 100,
                    ],
                    // 'quantity' => 1,
                    'quantity' => $cartItem->quantity,
                ];
            }

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', [], true),
                'cancel_url' => route('checkout.cancel', [], true),
            ]);

            // Create a new order
            $order = new Order();
            $order->user_id = Auth::id();
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->address_1 = $request->address_1;
            $order->address_2 = $request->address_2;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->country = $request->country;
            $order->phone = $request->phone;
            $order->payment_method = $paymentMethod;
            $order->order_number = Str::uuid()->toString();
            $order->payment_status = 'unpaid';
            $order->grand_total = Cart::getTotal();
            $order->item_count = Cart::getContent()->count();
            $order->session_id = $checkout_session->id;
            $order->save();

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

            /*--------------------------------------------------------------------------
            | User Billing and Shipping details Form Information Start
            |--------------------------------------------------------------------------*/

            // Update the user's details
            $userInfo->userDetails()->update([
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]);

            // Retrieve the user's billing details
            $billingDetails = BillingDetails::where('user_id', Auth::id())->first();

            if ($billingDetails) {
                // Billing details exist, update them
                $billingDetails->update([
                    'order_id' => $order->id,
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                ]);
            } else {
                // Billing details don't exist, create a new record
                $billingDetails = BillingDetails::create([
                    'user_id' => Auth::id(),
                    'order_id' => $order->id,
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                ]);
            }

            // Check if the "Ship to a different address?" checkbox is checked
            $shipToDifferentAddress = $request->has('ship_to_different_address');

            // Retrieve the user's billing details
            $billingDetails = BillingDetails::where('user_id', Auth::id())->first();

            if ($shipToDifferentAddress) {
                // Ship to a different address
                // Update or create shipping details
                $shippingDetails = ShippingDetails::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'order_id' => $order->id,
                        'address_1' => $request->shipping_address_1,
                        'address_2' => $request->shipping_address_2,
                        'city' => $request->shipping_city,
                        'state' => $request->shipping_state,
                        'zip' => $request->shipping_zip,
                        // 'country' => $request->shipping_country,
                        'phone' => $request->shipping_phone,
                    ]
                );
            } else {
                // Use billing details as shipping details
                $shippingDetails = ShippingDetails::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'order_id' => $order->id,
                        'address_1' => $billingDetails->address_1,
                        'address_2' => $billingDetails->address_2,
                        'city' => $billingDetails->city,
                        'state' => $billingDetails->state,
                        'zip' => $billingDetails->zip,
                        // 'country' => $billingDetails->country,
                        'phone' => $billingDetails->phone,
                    ]
                );
            }

            /*--------------------------------------------------------------------------
            | User Billing and Shipping details Form Information End
            |--------------------------------------------------------------------------*/

            return redirect($checkout_session->url);
        }

        // return back();

    }

    public function success()
    {
        return view('frontend.checkout.checkout-success');
    }

    public function cancel()
    {
        return view('frontend.checkout.checkout-cancel');
    }

    public function webhook()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload

            // http_response_code(400);
            // exit();
            return response('', 400);

        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature

            // http_response_code(400);
            // exit();

            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {

            // case 'payment_intent.succeeded':
            //     $paymentIntent = $event->data->object;
            // // ... handle other event types

            case 'checkout.session.completed':
                $checkoutSession = $event->data->object;
                $checkoutSessionId = $checkoutSession->id;

                $order = Order::where('session_id', $checkoutSessionId)->first();
                if(!$order) {
                    'No Order found';
                    // throw new NotFoundHttpException();
                }
                // $order->status = 'paid';
                // $order->save();


                if( $order && $order->status ==='unpaid'){
                    $order->status = 'paid';
                    $order->save();
                    // Send Email to Customer
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        // http_response_code(200);
        return response('');
    }

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
