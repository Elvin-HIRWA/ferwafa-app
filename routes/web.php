<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommitteController;
use App\Http\Controllers\GalleryController;
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
Route::get('/gallery', [GalleryController::class, 'getImages'])->name('gallery.images');
Route::get('/gallery/{fileName}', [GalleryController::class, 'displayGalleryImage'])->name('gallery.doc');
Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('form.login');
Route::get('/admin', [AdminController::class, 'adminView']);
Route::get('/news-view', [NewsController::class, 'getNewsForAdmin'])->name('news.view');
Route::get('/create-news', [AdminController::class, 'createNewsView'])->name('news.create');

Route::post('/signin', [AuthenticationController::class, 'signin'])->name('login');
Route::post('/post-news', [NewsController::class, 'postNews'])->name('post.news');
