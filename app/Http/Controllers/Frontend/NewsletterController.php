<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Newsletter\Facades\Newsletter;
// use Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request) {
        $request->validate([
            'subscriber_email' => 'required|email'
        ]);

        try {
            if(Newsletter::isSubscribed($request->subscriber_email)) {
                return redirect()->back()->with('error', 'Email already subscribed');
                // return redirect()->back()->with('error', 'Email already subscribed');
            } else {
                Newsletter::subscribe($request->subscriber_email);
                return redirect()->back()->with('success', 'Email subscribed successfully!');
                // return redirect()->back()->session()->flash('success', 'Email subscribed successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}


// namespace App\Http\Controllers\Frontend;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use DrewM\MailChimp\MailChimp;

// class NewsletterController extends Controller
// {
//     public function subscribe(Request $request)
//     {
//         $email = $request->input('email');

//         $mailchimp = new MailChimp(env('MAILCHIMP_API_KEY'));

//         $result = $mailchimp->post("lists/" . env('MAILCHIMP_LIST_ID') . "/members", [
//             'email_address' => $email,
//             'status' => 'subscribed',
//         ]);

//         if ($mailchimp->success()) {
//             // Subscription successful
//             return redirect()->back()->with('message', 'Subscription  Done');
//         } else {
//             // Subscription failed
//             return response()->json(['message' => 'Subscription failed', 'errors' => $mailchimp->getLastError()]);
//         }
//     }
// }
