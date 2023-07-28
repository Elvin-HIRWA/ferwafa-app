<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getPartnerImageDoc']]);
    }


    public function addPartner()
    {
        return view('admin.create-partner');
    }

    public function createPartner(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "link" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $path = $request->image->store('partner');

        Partner::create([
            "link" => $request->link,
            "image_url" => $path
        ]);

        return redirect('/parteners')
            ->with('message', 'Member is added successfully');
    }

    public function getPartnerImageDoc($fileName)
    {
        if (Storage::exists('partner/' . $fileName)) { {
                return response()->file(storage_path('/app/partner/' . $fileName));
            }
        }
    }

    public function listPartner()
    {
        $partners = Partner::all();

        $finalPartners = [];

        foreach ($partners as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $partner = [
                "id" => $value->id,
                "link" => $value->link,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalPartners, $partner);
        }

        return view('admin.partner', [
            'partners' => $finalPartners
        ]);
    }

    public function updatePartner(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "link" => "required|string",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg,svg"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json(["errors" => "Partner not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Storage::delete($partner->image_url);

        $path = $request->image->store('Partner');
        $partner->link = $request->name;
        $partner->image_url = $path;
        $partner->save();

        return response()->json(['message' => ['updated successfully']]);
    }


    public function deletePartner($id)
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json(["errors" => "Partner not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Storage::delete($partner->image_url);

        $partner->delete();

        return redirect('/parteners')
            ->with('message', 'Member is deleted');
    }
}
