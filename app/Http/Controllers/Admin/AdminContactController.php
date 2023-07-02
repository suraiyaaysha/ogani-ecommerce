<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;

class AdminContactController extends Controller
{
    public function contactList()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function contactShow(Contact $contact)
    {
        return view('admin.contact.contact-details', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        // For showing success message using sweet alert box
        if (request()->ajax()) {
            return response()->json(['message' => 'Contact deleted successfully']);
        }
        // For showing success message using sweet alert box

        return redirect()->back()->with('success', 'Contact deleted successfully');
    }

}
