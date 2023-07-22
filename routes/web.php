<?php

use App\Http\Controllers\CommitteController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [NewsController::class, 'getNews']);
Route::get('/news-file/{fileName}', [NewsController::class, 'getNewsImage'])->name('news.images.show');
Route::get('/all-news', [NewsController::class, 'allNews'])->name('all.news');
Route::get('/single-news/{id}', [NewsController::class, 'getSingleNews'])->name('single.news');
Route::get('/about', [CommitteController::class, 'listAllCommitte'])->name('about');
Route::get('/report', [ReportController::class, 'get'])->name('report');
Route::get('/report/{fileName}', [ReportController::class, 'getReportDoc'])->name('report.doc');
