<?php

namespace App\Http\Controllers;

use App\Mail\sendInfo;
use App\Mail\SendWhistleBlowers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function information()
    {
        return view('information');
    }

    public function whistleblowers()
    {
        return view('whistleblowers');
    }

    public function sendInfo(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email:rfc,dns",
            "subject" => "required|string",
            "content" => "required|string"
        ]);

        Mail::to('ferwafa@yahoo.fr')->send(new sendInfo(
            $request->name,
            $request->email,
            $request->subject,
            $request->content
        ));

        return redirect('/information');
    }

    public function sendWhistleblowers(Request $request)
    {
        $request->validate([
            "message" => "required|string"
        ]);

        Mail::to('ferwafa@yahoo.fr')->send(new SendWhistleBlowers(
            $request->message
        ));

        return redirect('/whistleblowers');
    }
}
