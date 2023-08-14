<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
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

    public function deleteSingleUser($id)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('fail', 'user not found');
        }

        $user->delete();

        return redirect('/users')
            ->with('message', 'user deleted successfully');
    }
}
