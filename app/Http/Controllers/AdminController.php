<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function newsView()
    {
        return view('admin.newslist');
    }
}
