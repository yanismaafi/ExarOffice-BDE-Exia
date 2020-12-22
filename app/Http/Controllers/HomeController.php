<?php

namespace App\Http\Controllers;

use App\Event;
use App\Contact;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;


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

    
    public function contact(ContactRequest $request)
    {
        Contact::create ([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json('success');
    }
}
