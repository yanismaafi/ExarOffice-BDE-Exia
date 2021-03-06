<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ToastNotifier;


class HomeController extends Controller
{

    public function index()
    {
        return view('index');
    }


    public function about()
    {
        return view('about');
    }

    
    public function contact (Request $request) 
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

        $contact->save();

        $notification = new ToastNotifier('success', 'Message envoyé', 'Votre message a été envoyé avec succès', null, null);
        return $notification->toJson();
    }
}
