<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function createNewsView()
    {
        return view('admin.create-news');
    }
    public function adminView()
    {
        return view('admin.admin');
    }

    public function getNewsForAdmin()
    {
        $news = DB::select(
            'SELECT a.*,b.image_url,c.name FROM 
                                News AS a
                                JOIN NewsUrl AS b
                                ON b.news_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id'
        );

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
                "created_at" => Carbon::parse($value->created_at)->format('Y-m-d'),
                "updated_at" => Carbon::parse($value->updated_at)->format('Y-m-d'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleNews);
        }

        return view('admin.newslist', [
            'news' => $result
        ]);
    }

    public function getEventsForAdmin()
    {
        $events = DB::select(
            'SELECT a.*,b.image_url,c.name AS statusName
                                 FROM 
                                Event AS a
                                JOIN EventUrl AS b
                                ON b.event_id = a.id
                                JOIN Status AS c
                                ON a.statusID = c.id'
        );
        
        $result = [];

        foreach ($events as $value) {
            $fileUrl = explode('/', $value->image_url)[1];
            $singleEvent = [
                "id" => $value->id,
                "name" => $value->name,
                "date" => $value->event_date,
                "description" => $value->description,
                "status" => $value->statusName,
                "created_at" => Carbon::parse($value->created_at)->format('d-m-Y'),
                "updated_at" => Carbon::parse($value->updated_at)->format('d-m-Y'),
                "image_url" => $fileUrl
            ];
            array_push($result, $singleEvent);
        }
        
        return view('admin.eventlist', [
            'events' => $result
        ]);
    }

    public function createEventsView()
    {
        return view('admin.create-events');
    }
}
