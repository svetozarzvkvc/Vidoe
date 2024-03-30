<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Mail\ContactMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends GenesisController
{
    //
    public function index()
    {
        return view('pages.client.contact');
    }

    public function store(ContactStoreRequest $request)
    {
        $email = $request->input('email');
        $subject = $request->input('subjectMoj');
        $body = $request->input('messageMoj');

        try {

            Mail::to('youremail@gmail.com')->send(new ContactMail($subject,$body,$email));


            return redirect()->back()->with("messages", "Your email was sent successfully.");
        } catch(Exception $ex) {
            return redirect()->back()->with('error-msg',"Your have and error: ".$ex->getMessage());
        }

    }
}
