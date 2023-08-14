<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommitteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getComitteImageDoc', 'listAllCommitte']]);
    }

    public function addMember()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        return view('admin.create-committe');
    }

    public function createCommitte(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $validation = Validator::make($request->all(), [
            "name" => "required|string",
            "position" => "required|string|max:255",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $path = $request->image->store('committe');

        Committe::create([
            "name" => $request->name,
            "position" => $request->position,
            "image_url" => $path
        ]);

        return redirect('/committe')
            ->with('message', 'Member is added successfully');
    }

    public function getComitteImageDoc($fileName)
    {
        if (Storage::exists('committe/' . $fileName)) { {
                return response()->file(storage_path('/app/committe/' . $fileName));
            }
        }
    }

    public function listCommitte()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::all();

        $finalCommitte = [];

        foreach ($committe as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $committeMember = [
                "id" => $value->id,
                "name" => $value->name,
                "position" => $value->position,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCommitte, $committeMember);
        }

        return view('admin.committe', [
            'committes' => $finalCommitte
        ]);
    }

    public function listAllCommitte()
    {
        $committe = Committe::all();

        $finalCommitte = [];

        foreach ($committe as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $committeMember = [
                "id" => $value->id,
                "name" => $value->name,
                "position" => $value->position,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCommitte, $committeMember);
        }

        return view('about', [
            'committe' => $finalCommitte
        ]);
    }

    public function editCommitte($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::find($id);

        if (!$committe) {
            return redirect()->back()->with('fail', 'member not found');
        }

        return view('admin.update-committe', [
            'committe' => $committe
        ]);
    }

    public function updateCommitte(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "position" => "required|string|max:255",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"

        ]);

        $committe = Committe::find($id);

        if (!$committe) {
            return redirect()->back()->with('fail', 'member not found');
        }

        Storage::delete($committe->image_url);

        $path = $request->image->store('committe');
        $committe->name = $request->name;
        $committe->position = $request->position;
        $committe->image_url = $path;
        $committe->save();

        return redirect('/committe')
            ->with('message', 'updated successfully');
    }


    public function deleteCommitte($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $committe = Committe::find($id);

        if (!$committe) {
            return response()->json(["errors" => "committe not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Storage::delete($committe->image_url);

        $committe->delete();

        return redirect('/committe')
            ->with('message', 'Member is deleted');
    }
}
