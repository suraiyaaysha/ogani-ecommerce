<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\BillingDetails;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Fetch additional information related to the order if needed
        $order->load('orderItems.product');

        return view('frontend.orders.show', compact('order'));
    }

    //  public function storeBillingDetails(Request $request)
    // {
    //     $orderId = $request->input('order_id');
    //     $userId = $request->input('user_id');
    //     $address1 = $request->input('address_1');
    //     $address2 = $request->input('address_2');
    //     $city = $request->input('city');
    //     $state = $request->input('state');
    //     $zip = $request->input('zip');

    //     $order = Order::find($orderId); // Get the order instance

    //     $billingDetails = new BillingDetails();
    //     $billingDetails->user_id = $userId;
    //     $billingDetails->order_id = $order->id; // Set the order_id
    //     $billingDetails->address_1 = $address1;
    //     $billingDetails->address_2 = $address2;
    //     $billingDetails->city = $city;
    //     $billingDetails->state = $state;
    //     $billingDetails->zip = $zip;
    //     $billingDetails->save();

    //     // You can add any additional logic or redirect to a success page
    // }

}
