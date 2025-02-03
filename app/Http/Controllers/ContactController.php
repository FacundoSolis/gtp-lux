<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Helpers\TranslationHelper;


class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5',
        ]);

        Mail::to('support@gtplux.com')->send(new ContactMail(
            $request->name,
            $request->email,
            $request->message
        ));

        return back()->with('success', TranslationHelper::get('email.contact_received'));
    }
}
