<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsers(UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $users = $service->getAllUsers();

        return response()->json($users);
    }

    public function getUsers(UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $users = $service->getAllUsers();

        return view('admin.users', [
            "users" => $users
        ]);
    }

    public function getSingleUser($id, UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $user = $service->getSingleUser($id);

        return response()->json($user);
    }
}
