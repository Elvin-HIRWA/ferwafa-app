<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommitteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SendingKeyController;
use App\Http\Controllers\UsersController;
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

Route::get('/committe', [CommitteController::class, 'listCommitte'])->name('committe');
Route::get('/add-committe', [CommitteController::class, 'addMember'])->name('add.committe');
Route::post('/create', [CommitteController::class, 'createCommitte'])->name('create.committe');
Route::delete('/delete/{id}', [CommitteController::class, 'deleteCommitte'])->name('delete.committe');

Route::get('/report', [ReportController::class, 'get'])->name('report');
Route::get('/document/{fileName}', [ReportController::class, 'getReportDoc'])->name('report.doc');

Route::get('/gallery', [GalleryController::class, 'getImages'])->name('gallery.images');
Route::get('/gallery/{fileName}', [GalleryController::class, 'displayGalleryImage'])->name('gallery.doc');
Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('form.login');
Route::get('/register', [AuthenticationController::class, 'registerForm'])->name('register.login');
Route::get('/admin', [AdminController::class, 'adminView'])->name('dashboard.view');
Route::get('/news-view', [AdminController::class, 'getNewsForAdmin'])->name('news.view');
Route::get('/create-news', [AdminController::class, 'createNewsView'])->name('news.create');

Route::get('/event-view', [AdminController::class, 'getEventsForAdmin'])->name('events.view');
Route::get('/create-event', [AdminController::class, 'createEventsView'])->name('events.create');
Route::post('/post-event', [EventController::class, 'createEvent'])->name('post.event');
Route::get('/event-file/{fileName}', [EventController::class, 'getEventImage'])->name('events.images.show');
Route::get('/all-events', [EventController::class, 'allEvents'])->name('all.events');
Route::get('/single-event/{id}', [EventController::class, 'getSingleEvent'])->name('single.event');

Route::get('/send-key', [SendingKeyController::class, 'sendKey'])->name('send.key');
Route::post('/sending-key', [SendingKeyController::class, 'sendingKey'])->name('sending.key');

Route::get('/report-view', [ReportController::class, 'getReport'])->name('reports.view');
Route::get('/add-doc', [ReportController::class, 'addDocument'])->name('add.doc');

Route::get('/commite-doc/{fileName}', [CommitteController::class, 'getComitteImageDoc'])->name('comitte.doc');

Route::post('/signin', [AuthenticationController::class, 'signin'])->name('login');
Route::post('/post-news', [NewsController::class, 'postNews'])->name('post.news');


Route::post('/send-information', [ContactController::class, 'sendInfo'])->name('post.send.info');
Route::post('/send-whistleblowers', [ContactController::class, 'sendWhistleblowers'])->name('post.send.whistle');
Route::get('/information', [ContactController::class, 'information'])->name('information');
Route::get('/whistleblowers', [ContactController::class, 'whistleblowers'])->name('whistleblowers');

Route::get('/users', [UsersController::class, 'getUsers'])->name('users.view');


Route::get('/parteners', [PartnerController::class, 'listPartner'])->name('partner');
Route::get('/add-partener', [PartnerController::class, 'addPartner'])->name('add.partner');
Route::post('/create-partener', [PartnerController::class, 'createPartner'])->name('create.partner');
Route::delete('/delete-partner/{id}', [PartnerController::class, 'deletePartner'])->name('delete.partner');
Route::get('/partner-doc/{fileName}', [PartnerController::class, 'getPartnerImageDoc'])->name('partner.doc');

Route::post('/create', [ReportController::class, 'create'])->name('create.report');
Route::delete('/report-delete/{id}', [ReportController::class, 'deleteReport'])->name('delete.report');
