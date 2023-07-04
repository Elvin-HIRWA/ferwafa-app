<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsUrl;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function postNews(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "caption" => "required|string|max:255",
            "description" => "required|string",
            "is_top" => "boolean",
            "image" => "file|max:5000|mimes:png,jpg,jpeg"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if($request->hasFile('image'))
        {
            $path = $request->image->store('newsImages');
        }

        $news = News::create([
            "title" => $request->title,
            "caption" => $request->caption,
            "description" => $request->description,
            "is_top" => $request->is_top
        ]);

        NewsUrl::create([
            "image_url" => $path,
            // "image_caption" => $request->image_caption,
            "news_id" => $news->id
        ]);

        return response()->json(['message' => 'success']);
    }


    public function getNews()
    {
        $result = News::all();

        return response()->json($result);
    }
}
