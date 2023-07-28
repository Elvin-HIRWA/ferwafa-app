<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsers(UserService $service)
    {
        $users = $service->getAllUsers();

        return response()->json($users);
    }

    public function getUsers(UserService $service)
    {
        $users = $service->getAllUsers();

        return view('admin.users', [
            "users" => $users
        ]);
    }

    public function getSingleUser($id,UserService $service)
    {
        $user = $service->getSingleUser($id);

        return response()->json($user);
    }
}
