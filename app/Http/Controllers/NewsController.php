<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsUrl;
use App\Models\Partner;
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
        $request->validate([
            "title" => "required|string",
            "caption" => "required|string|max:255",
            "description" => "required|string",
            "is_top" => "required|boolean",
            "statusID" => "required|in:1,2,3",
            "image" => "required|file|max:5000|mimes:png,jpg,jpeg"
        ]);

        DB::transaction(function () use ($request) {

            $news = News::create([
                "title" => $request->title,
                "caption" => $request->caption,
                "description" => $request->description,
                "statusID" => $request->statusID,
                "is_top" => $request->is_top
            ]);

            $path = $request->image->store('newsImages');
            NewsUrl::create([
                "image_url" => $path,
                // "image_caption" => $request->image_caption,
                "news_id" => $news->id
            ]);
        });


        return redirect('/news-view')
            ->with('message', 'News has been created!');
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
                                JOIN Status AS c
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
                                JOIN Status AS c
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

        $partners = Partner::all();

        $finalPartners = [];

        foreach ($partners as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $partner = [
                "id" => $value->id,
                "link" => $value->name,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalPartners, $partner);
        }

        return view('home', [
            "result" => $result,
            'partners' => $finalPartners
        ]);
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
