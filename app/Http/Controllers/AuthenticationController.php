<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }
    public function createAccount(Request $request)
    {

        $request->validate([
            "key" => "required|string|min:10",
            "name" => "required|string|max:255",
            "email" => "required|email:rfc,dns",
            "password" => "required|string|min:6|confirmed"
        ]);

        $key = Key::where("value", $request->key)->first();

        if (!$key) {
            return redirect()->back()->with('fail', 'Key not found');
        }

        $user = User::create([
            'keyID' => $key->id,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name
        ]);

        // $permissions = User::getUserPermission($user->id);

        // $permissionname = $permissions[0]->permissionname;
        // $token = $user->createToken('token', [$permissionname])->plainTextToken;

        return redirect()->back()->with('success', 'Registered successfully');
        // \response()->json([
        //     "token" => $token,
        //     "permissionName" => $permissionname,
        //     "userID" => $user->id
        // ]);
    }

    public function signin(Request $request)
    {
        // dd('here');
        $request->validate([
            "email" => "required|email:rfc,dns",
            "password" => "required|string|min:6"
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('fail', 'User not found');
        }


        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('fail', 'Invalid credentials');
        }

        Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        // Auth::user()->tokens()->delete();

        // $id = Auth::id();

        // $permissions = User::getUserPermission($id);

        // $permissionname = $permissions[0]->permissionname;
        // $token = Auth::user()->createToken('token', [$permissionname])->plainTextToken;

        return redirect()->route('dashboard.view')->with('success','Logged In Successfully');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();


        return response()->json([
            'message' => 'Tokens Revoked'
        ], Response::HTTP_OK);
    }

    public function registerForm(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        return view('register', [
            'email' => $email,
            'token' => $token
        ]);
    }
}
