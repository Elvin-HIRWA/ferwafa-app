<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Services\SendingKeyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SendingKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendKey()
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $keys = Key::getKeyWithTheirPermission();

        return view('admin.sendKey', [
            "keys" => $keys
        ]);
    }

    public function sendingKey(Request $request, SendingKeyService $services)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "key" => "required|int",
            "email" => "required|email:rfc,dns",
        ]);

        $getkey = Key::find($request->key);

        if ($getkey === null) {
            return redirect()->back()->with('fail', 'No key entered or invalid key');
        }

        $getvalue = $getkey->value;

        $services->SendingKey(
            $request->email,
            $getvalue

        );

        return redirect('/users')->with('message', 'email to send key has been sent');
    }
}
