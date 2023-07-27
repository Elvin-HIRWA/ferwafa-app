<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommitteController extends Controller
{
    public function addMember()
    {
        return view('admin.create-committe');
    }
    public function createCommitte(Request $request)
    {
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

    public function updateCommitte(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required|string",
            "position" => "required|string|max:255",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $committe = Committe::find($id);

        if (!$committe) {
            return response()->json(["errors" => "committe not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Storage::delete($committe->image_url);

        $path = $request->image->store('committe');
        $committe->name = $request->name;
        $committe->position = $request->position;
        $committe->image_url = $path;
        $committe->save();

        return response()->json(['message' => ['updated successfully']]);
    }


    public function deleteCommitte($id)
    {
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
