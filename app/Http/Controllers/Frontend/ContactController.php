<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function contactCms()
    {
        $cms = Cms::first();
        return view('frontend.contact.index', compact('cms'));
    }

    // public function storeContactForm(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'message' => 'required',
    //     ]);

    //     // $existingContact = Contact::where('email', $request->email)->first();

    //     // if ($existingContact) {
    //     //     // Handle the case when the email already exists
    //     //     return back()->with('error', 'Email already exists.');
    //     // } else {
    //     //     // Proceed with inserting the new contact

    //     //     // Create a new Contact model instance and save the form data
    //     //     $contact = new Contact();
    //     //     $contact->name = $request->name;
    //     //     $contact->email = $request->email;
    //     //     $contact->message = $request->message;
    //     //     $contact->save();

    //     //     // Send email to the user
    //     //     $mailData = [
    //     //         'name' => $contact->name,
    //     //         'email' => $contact->email,
    //     //         'message' => $contact->message,
    //     //     ];

    //     //     Mail::to($contact->email)->send(new ContactFormMail($mailData));

    //     //     // Redirect back with a success message
    //     //     return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    //     // }


    //     // Proceed with inserting the new contact

    //     // Create a new Contact model instance and save the form data
    //     $contact = new Contact();
    //     $contact->name = $request->name;
    //     $contact->email = $request->email;
    //     $contact->message = $request->message;
    //     $contact->save();

    //     // Send email to the user
    //     $mailData = [
    //         'name' => $contact->name,
    //         'email' => $contact->email,
    //         'message' => $contact->message,
    //     ];

    //     Mail::to($contact->email)->send(new ContactFormMail($mailData));

    //     // Redirect back with a success message
    //     return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');

    // }

    public function storeContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if (auth()->check()) {
            // User is logged in, use their name and email
            // $name = auth()->user()->name;
            $name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $email = auth()->user()->email;
        } else {
            // User is not logged in, use the input name and email
            $name = $request->name;
            $email = $request->email;
        }

        // Proceed with inserting the new contact
        $contact = new Contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $request->message;
        $contact->save();

        // Send email to the user
        $mailData = [
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
            'appName' => config('app.name'),
        ];

        Mail::to($contact->email)->send(new ContactFormMail($mailData));

        // Redirect back with a success message
        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
