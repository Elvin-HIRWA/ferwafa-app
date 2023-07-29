<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getImages', 'displayGalleryImage']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function getImages()
    {
        $gallerries = DB::table('Gallery')->paginate();

        $finalGallery = [];

        foreach ($gallerries as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $gallery = [
                "id" => $value->id,
                "name" => $value->name,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "height" => $value->height,
                "width" => $value->width,
                "url" => $fileUrl
            ];
            array_push($finalGallery, $gallery);
        }

        return view('gallery', [
            'galleries' => $finalGallery
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function displayGalleryImage($fileName)
    {
        if (Storage::exists('gallery/' . $fileName)) { {
                return response()->file(storage_path('/app/gallery/' . $fileName));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
