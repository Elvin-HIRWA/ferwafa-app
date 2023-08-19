<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Key;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;


    protected $userPermission;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'key' => ['required', 'string', 'min:10']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $key = Key::where("value", $data['key'])->first();

        if (!$key) {
            return redirect()->back()->with('fail', 'Key not found');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'keyID' => $key->id
        ]);
    }

    private function registered(Request $request)
    {
        $userPermission = DB::table('users')
            ->select('Permission.name')
            ->join('KeyPermission', 'users.keyID', '=', 'KeyPermission.id')
            ->join('Permission', 'KeyPermission.permissionID', '=', 'Permission.id')
            ->where('email', $request->email)
            ->first();

        if ($userPermission->name == 'admin') {
            return redirect('/admin');
        } elseif ($userPermission->name == 'dcm') {
            return redirect('/news-view');
        } elseif ($userPermission->name == 'competition-manager') {
            return redirect('/seasons');
        } else {
            return redirect('/');
        }
    }

    public function showRegistrationForm(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        return view('auth.register', [
            'email' => $email,
            'token' => $token
        ]);
    }
}
