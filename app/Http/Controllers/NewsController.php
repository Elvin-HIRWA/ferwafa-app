<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsUrl;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
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

        if ($request->hasFile('image')) {
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

    public function getSingleNews($id)
    {
        $result = News::where('id', $id)->first();

        return response()->json($result);
    }

    public function updateSingleNews(Request $request, $id)
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

        $news = News::where("id", $id)->first();

        if (!$news) {
            throw new Exception('news not found');
        }

        $news->title = $request->title;
        $news->caption = $request->caption;
        $news->description = $request->description;
        $news->is_top = $request->is_top;
        $news->save();

        $path = $request->image->store('newsImages');

        $newsImage = NewsUrl::where('news_id', $news->id)->first();

        Storage::delete($newsImage->image_url);

        $newsImage->image_url = $path;

        $newsImage->save();

        return response()->json(['message' => ['updated successfully']]);
    }


    public function deleteNews($id)
    {
        $news = News::where("id", $id)->first();

        if (!$news) {
            throw new Exception('news not found');
        }

        $newsImage = NewsUrl::where('news_id', $news->id)->first();

        Storage::delete($newsImage->image_url);

        $newsImage->delete();

        $news->delete();

        return response()->json(['message' => ['deleted successfully']]);
    }
}
