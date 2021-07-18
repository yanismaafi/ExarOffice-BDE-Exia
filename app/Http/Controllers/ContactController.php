<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request) 
    {
        $request->validate([
            'lname' => 'required|string|min:2|max:120',
            'fname' => 'required|string|min:2|max:120',
            'email' => 'required|string|email|max:120',
            'subject' => 'required|string|min:4|max:120',
            'message' => 'required|string|min:8',
        ]);

        $contact = new Contact();
        $contact->lname = ucfirst($request->lname);
        $contact->fname = ucfirst($request->fname);
        $contact->subject = ucfirst($request->subject);
        $contact->message = ucfirst($request->message);

        $notification = new ToastNotifier('success', 'Message envoyé', 'Votre message a été envoyé avec succès', null, null);
        return $notification->toJson();
    }
}
