<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsUrl;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
            "statusID" => "required|integer|in:1,2,3",
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
            "statusID" => $request->statusID,
            "is_top" => $request->is_top
        ]);

        NewsUrl::create([
            "image_url" => $path,
            // "image_caption" => $request->image_caption,
            "news_id" => $news->id
        ]);

        return response()->json(['message' => 'success']);
    }

    public function getNewsForAdmin()
    {
        $news = DB::select(
            'SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN NewsStatus AS c
                                ON a.statusID = c.id'
        );

        $result = [];

        foreach ($news as $value) {
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('Y-m-d'),
                "updated_at" => Carbon::parse($value->updated_at)->format('Y-m-d'),
                "image_url" => $value->image_url
            ];
            array_push($result, $singleNews);
        }

        return response()->json($result);
    }

    public function getNewsImage($fileName)
    {
        if (Storage::exists('newsImages/' . $fileName)) { {
                return response()->file(storage_path('/app/newsImages/' . $fileName));
            }
        }
    }

    public function allNews()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN NewsStatus AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC');

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view(
            'all_news',
            ["result" => $result]
        );
    }
    public function getNews()
    {
        $news = DB::select('SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN NewsStatus AS c
                                ON a.statusID = c.id
                                WHERE  c.id = 1
                                ORDER BY created_at DESC
                                LIMIT 4');

        $result = [];

        foreach ($news as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleNews = [
                "id" => $value->id,
                "title" => $value->title,
                "caption" => $value->caption,
                "description" => $value->description,
                "is_top" => $value->is_top,
                "status" => $value->name,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view('home', ["result" => $result]);
    }

    public function getSingleNews($id)
    {
        $result = News::where('id', $id)->first();
        $newsUrls = NewsUrl::where('news_id', $id)->get();
        $urls = [];
        foreach ($newsUrls as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $newsUrl = [
                'url' => $fileUrl,
                'image_caption' => $value->image_caption
            ];
            array_push($urls, $newsUrl);
        }
        return view('single_news', [
            'result' => $result,
            'url' => $urls
        ]);
    }

    public function updateSingleNews(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|string",
            "caption" => "required|string|max:255",
            "description" => "required|string",
            "is_top" => "boolean",
            "statusID" => "required|integer|in:1,2,3",
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
        $news->statusID = $request->statusID;
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
