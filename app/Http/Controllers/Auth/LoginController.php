<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    private function authenticated(Request $request)
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
            return redirect('/news-view');
        } else {
            return redirect('/admin');
        }
    }
}
