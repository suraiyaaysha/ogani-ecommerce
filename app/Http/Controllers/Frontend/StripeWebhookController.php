<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Stripe\Event;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe_webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], Response::HTTP_BAD_REQUEST);
        }

        // Handle different event types
        if ($event->type === 'charge.succeeded') {
            // Handle successful charge event
            $charge = $event->data->object;
            // TODO: Update your application's data or take necessary actions
        } elseif ($event->type === 'checkout.session.completed') {

            // Handle checkout session completed event
            // $session = $event->data->object;
            // TODO: Update your application's data or take necessary actions

                $session = $event->data->object;
                $session = $checkoutSession->id;

                $order = Order::where('session_id', $session)->first();
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


        } elseif ($event->type === 'payment_intent.succeeded') {
            // Handle successful payment intent event
            $paymentIntent = $event->data->object;
            // TODO: Update your application's data or take necessary actions
        } elseif ($event->type === 'payment_intent.created') {
            // Handle payment intent created event
            $paymentIntent = $event->data->object;
            // TODO: Update your application's data or take necessary actions
        }

        return response()->json(['success' => true]);
    }

    //     public function handleWebhook(Request $request)
    // {
    //     $payload = $request->getContent();
    //     $sigHeader = $request->header('Stripe-Signature');
    //     $endpointSecret = config('services.stripe.webhook_secret');

    //     try {
    //         $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
    //     } catch (\Stripe\Exception\SignatureVerificationException $e) {
    //         return response()->json(['error' => 'Invalid signature'], Response::HTTP_BAD_REQUEST);
    //     }

    //     // Handle different event types
    //     if ($event->type === 'charge.succeeded') {
    //         // Handle successful charge event
    //         $charge = $event->data->object;
    //         // TODO: Update your application's data or take necessary actions
    //     } elseif ($event->type === 'checkout.session.completed') {
    //         // Handle checkout session completed event
    //         $session = $event->data->object;
    //         // TODO: Update your application's data or take necessary actions
    //     } elseif ($event->type === 'payment_intent.succeeded') {
    //         // Handle successful payment intent event
    //         $paymentIntent = $event->data->object;
    //         // TODO: Update your application's data or take necessary actions
    //     } elseif ($event->type === 'payment_intent.created') {
    //         // Handle payment intent created event
    //         $paymentIntent = $event->data->object;
    //         // TODO: Update your application's data or take necessary actions
    //     }

    //     return response()->json(['success' => true]);
    // }
}
