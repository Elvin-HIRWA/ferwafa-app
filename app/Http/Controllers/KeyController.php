<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\Permission;
use App\Models\User;
use App\Services\KeyService;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class KeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keyCreate(Request $request, KeyService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $validation = Validator::make($request->all(), [
            "permissionKey" => "required|integer",
            "keyName" => "required|string",
        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $key = Permission::find($request->permissionKey);

        if ($key === null) {
            return response()->json(["Id not found"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $service->createKey($request->permissionKey, $request->keyName);

        return response()->json(["Key Created"], Response::HTTP_CREATED);
    }

    //List Keys
    public function listKey(KeyService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $results = $service->listKey();

        return Response()->json($results);
    }

    //Get single Key By ID
    public function getKey($id, KeyService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $results = $service->getKey($id);

        return Response()->json($results);
    }

    //Delete Key
    public function deleteKey($id, KeyService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $key = Key::find($id);

        if ($key === null) {
            return response()->json(["Id not found"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userKeyID = User::where("keyID", $id)->first();

        if ($userKeyID === null) {
            $service->deleteKey($id);
            return response()->json(["key deleted successfully"], Response::HTTP_CREATED);
        }

        return response()->json(["you can not delete key is used by another user"], Response::HTTP_FORBIDDEN);
    }

    public function permissionKeyList(PermissionService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        
        $results = $service->keyPermission();

        return Response()->json($results);
    }
}
