<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommitteController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendingKeyController;
use App\Http\Controllers\UsersController;
use App\Models\Status;
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

Route::get('/home', function () {
    return view('home');
});
Route::get('/', [NewsController::class, 'getNews']);
Route::get('/news-file/{fileName}', [NewsController::class, 'getNewsImage'])->name('news.images.show');
Route::get('/all-news', [NewsController::class, 'allNews'])->name('all.news');
Route::get('/single-news/{id}', [NewsController::class, 'getSingleNews'])->name('single.news');
Route::delete('/news/{id}', [NewsController::class, 'deleteNews'])->name('news.delete');
Route::get('/about', [CommitteController::class, 'listAllCommitte'])->name('about');

Route::get('/committe', [CommitteController::class, 'listCommitte'])->name('committe');
Route::get('/add-committe', [CommitteController::class, 'addMember'])->name('add.committe');
Route::post('/create-committe', [CommitteController::class, 'createCommitte'])->name('create.committe');
Route::delete('/delete/{id}', [CommitteController::class, 'deleteCommitte'])->name('delete.committe');

Route::get('/report', [ReportController::class, 'get'])->name('report');
Route::get('/document/{fileName}', [ReportController::class, 'getReportDoc'])->name('report.doc');


Route::get('/gallery', [GalleryController::class, 'getImages'])->name('gallery.images');
Route::get('/gallery/{fileName}', [GalleryController::class, 'displayGalleryImage'])->name('gallery.doc');
Route::get('/gallery-view', [GalleryController::class, 'galleryList'])->name('admin.gallery.list');
Route::get('/add-photo', [GalleryController::class, 'addGallery'])->name('post.photo.view');
Route::post('/create-photo', [GalleryController::class, 'createGallery'])->name('post.photo');

Route::get('/edit-gallery/{id}', [GalleryController::class, 'edit'])->name('edit.gallery');
Route::put('/update-gallery/{id}', [GalleryController::class, 'update'])->name('update.photo');
Route::delete('/delete-gallery/{id}', [GalleryController::class, 'destroy'])->name('delete.photo');


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
Route::post('/post-news', [NewsController::class, 'postNews'])->name('post.news');


Route::post('/send-information', [ContactController::class, 'sendInfo'])->name('post.send.info');
Route::post('/send-whistleblowers', [ContactController::class, 'sendWhistleblowers'])->name('post.send.whistle');
Route::get('/information', [ContactController::class, 'information'])->name('information');
Route::get('/whistleblowers', [ContactController::class, 'whistleblowers'])->name('whistleblowers');


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [UsersController::class, 'getUsers'])->name('users.view');
Route::delete('/user/{id}', [UsersController::class, 'deleteSingleUser'])->name('users.delete');


Route::get('/parteners', [PartnerController::class, 'listPartner'])->name('partner');
Route::get('/add-partener', [PartnerController::class, 'addPartner'])->name('add.partner');
Route::post('/create-partener', [PartnerController::class, 'createPartner'])->name('create.partner');
Route::delete('/delete-partner/{id}', [PartnerController::class, 'deletePartner'])->name('delete.partner');
Route::get('/partner-doc/{fileName}', [PartnerController::class, 'getPartnerImageDoc'])->name('partner.doc');

Route::post('/create', [ReportController::class, 'create'])->name('create.report');
Route::delete('/report-delete/{id}', [ReportController::class, 'deleteReport'])->name('delete.report');

Route::get('/document', [DocumentController::class, 'showDocumentPage'])->name('document.page.show');
Route::get('/games-rules', [DocumentController::class, 'showGameRules'])->name('laws.page.show');
Route::get('/additional-rules', [DocumentController::class, 'showAdditionalGameRules'])->name('rules.page.show');
Route::get('/circular', [DocumentController::class, 'showCircularPage'])->name('circular.page.show');
Route::get('/tender', [DocumentController::class, 'showTendersPage'])->name('tender.page.show');
Route::get('/jobs', [DocumentController::class, 'showJobsPage'])->name('jobs.page.show');
Route::get('/other-career', [DocumentController::class, 'showOtherCareerPage'])->name('career.page.show');

Route::put('/update-report/{id}', [ReportController::class, 'updateReport'])->name('update.report');
Route::get('/edit-report/{id}', [ReportController::class, 'editReport'])->name('document.page.edit');

Route::put('/update-committe/{id}', [CommitteController::class, 'updateCommitte'])->name('update.committe');
Route::get('/edit-committe/{id}', [CommitteController::class, 'editCommitte'])->name('committe.page.edit');

Route::put('/update-partner/{id}', [PartnerController::class, 'updatePartner'])->name('update.partner');
Route::get('/edit-partner/{id}', [PartnerController::class, 'editPartner'])->name('partner.page.edit');


Route::put('/news/{id}', [NewsController::class, 'updateSingleNews'])->name('news.page.update');
Route::get('/update-news/{id}', [NewsController::class, 'editSingleNews'])->name('news.page.edit');


Route::get('/seasons', [SeasonController::class, 'listSeason'])->name('season');
Route::get('/add-season', [SeasonController::class, 'addSeason'])->name('add.season');
Route::post('/create-season', [SeasonController::class, 'createSeason'])->name('create.season');
Route::delete('/delete-season/{id}', [SeasonController::class, 'deleteSeason'])->name('delete.season');
// Route::put('/update-season/{id}', [SeasonController::class, 'updateSeason'])->name('update.season');
// Route::get('/edit-season/{id}', [SeasonController::class, 'editSeason'])->name('season.page.edit');



Route::get('/days', [DayController::class, 'listDays'])->name('day.season');
Route::get('/add-day', [DayController::class, 'addDay'])->name('add.day.season');
Route::post('/create-day', [DayController::class, 'createDay'])->name('create.day.season');
Route::delete('/delete-day/{id}', [DayController::class, 'deleteDay'])->name('delete.day.season');


Route::get('/men-first-division-table', [CompetitionController::class, 'menFirstDivisionTable'])->name('men.first-division-table');
Route::get('/men-first-division-d1', [CompetitionController::class, 'menFirstDivisionD1'])->name('men.first-division-d1');
Route::get('/men-first-division-d2', [CompetitionController::class, 'menFirstDivisionD2'])->name('men.first-division-d2');
Route::get('/men-first-division-d3', [CompetitionController::class, 'menFirstDivisionD3'])->name('men.first-division-d3');
Route::get('/men-first-division-d4', [CompetitionController::class, 'menFirstDivisionD4'])->name('men.first-division-d4');
Route::get('/men-first-division-d5', [CompetitionController::class, 'menFirstDivisionD5'])->name('men.first-division-d5');
Route::get('/men-first-division-d6', [CompetitionController::class, 'menFirstDivisionD6'])->name('men.first-division-d6');
Route::get('/men-first-division-d7', [CompetitionController::class, 'menFirstDivisionD7'])->name('men.first-division-d7');
Route::get('/men-first-division-d8', [CompetitionController::class, 'menFirstDivisionD8'])->name('men.first-division-d8');
Route::get('/men-first-division-d9', [CompetitionController::class, 'menFirstDivisionD9'])->name('men.first-division-d9');
Route::get('/men-first-division-d10', [CompetitionController::class, 'menFirstDivisionD10'])->name('men.first-division-d10');
Route::get('/men-first-division-d11', [CompetitionController::class, 'menFirstDivisionD11'])->name('men.first-division-d11');
Route::get('/men-first-division-d12', [CompetitionController::class, 'menFirstDivisionD12'])->name('men.first-division-d12');
Route::get('/men-first-division-d13', [CompetitionController::class, 'menFirstDivisionD13'])->name('men.first-division-d13');
Route::get('/men-first-division-d14', [CompetitionController::class, 'menFirstDivisionD14'])->name('men.first-division-d14');
Route::get('/men-first-division-d15', [CompetitionController::class, 'menFirstDivisionD15'])->name('men.first-division-d15');
Route::get('/men-first-division-d16', [CompetitionController::class, 'menFirstDivisionD16'])->name('men.first-division-d16');
Route::get('/men-first-division-d17', [CompetitionController::class, 'menFirstDivisionD17'])->name('men.first-division-d17');
Route::get('/men-first-division-d18', [CompetitionController::class, 'menFirstDivisionD18'])->name('men.first-division-d18');
Route::get('/men-first-division-d19', [CompetitionController::class, 'menFirstDivisionD19'])->name('men.first-division-d19');
Route::get('/men-first-division-d20', [CompetitionController::class, 'menFirstDivisionD20'])->name('men.first-division-d20');
Route::get('/men-first-division-d21', [CompetitionController::class, 'menFirstDivisionD21'])->name('men.first-division-d21');
Route::get('/men-first-division-d22', [CompetitionController::class, 'menFirstDivisionD22'])->name('men.first-division-d22');
Route::get('/men-first-division-d23', [CompetitionController::class, 'menFirstDivisionD23'])->name('men.first-division-d23');
Route::get('/men-first-division-d24', [CompetitionController::class, 'menFirstDivisionD24'])->name('men.first-division-d24');
Route::get('/men-first-division-d25', [CompetitionController::class, 'menFirstDivisionD25'])->name('men.first-division-d25');
Route::get('/men-first-division-d26', [CompetitionController::class, 'menFirstDivisionD26'])->name('men.first-division-d26');
Route::get('/men-first-division-d27', [CompetitionController::class, 'menFirstDivisionD27'])->name('men.first-division-d27');
Route::get('/men-first-division-d28', [CompetitionController::class, 'menFirstDivisionD28'])->name('men.first-division-d28');
Route::get('/men-first-division-d29', [CompetitionController::class, 'menFirstDivisionD29'])->name('men.first-division-d29');
Route::get('/men-first-division-d30', [CompetitionController::class, 'menFirstDivisionD30'])->name('men.first-division-d30');


Route::get('/create', function () {
    Status::create([
        'name' => 'unpublished',
    ]);
});

// Route::get('/days', [CompetitionController::class, 'listDays']);

Route::get('/day/{id}', [CompetitionController::class, 'show'])->name('fixtures.show');
