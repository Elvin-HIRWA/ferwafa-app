<?php

namespace App\Http\Controllers;

use App\Mail\sendInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            "Content" => "required|string"
        ]);

        Mail::to('ferwafa@yahoo.fr')->send(new sendInfo(
            $request->name,
            $request->email,
            $request->subject,
            $request->content
        ));
    }
}
