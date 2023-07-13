<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SendingKeyController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthenticationController::class, 'createAccount']);
    Route::post('/login', [AuthenticationController::class, 'signin']);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset']);
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgot']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('report')->group(function () {
    Route::post('/create', [ReportController::class, 'create']);
    Route::get('/list', [ReportController::class, 'get']);
    Route::get('/get/{id}', [ReportController::class, 'getSingle']);
    Route::get('/report/{fileName}', [ReportController::class, 'getReportDoc']);
    Route::post('/update/{id}', [ReportController::class, 'updateReport']);
    Route::delete('/delete/{id}', [ReportController::class, 'deleteReport']);
});

Route::post('/post-news', [NewsController::class, 'postNews'])->middleware(['auth:sanctum', 'ability:dcm']);
Route::get('/latest-news', [NewsController::class, 'getNews']);
Route::get('/news/{id}', [NewsController::class, 'getSingleNews']);
Route::post('/news/{id}', [NewsController::class, 'updateSingleNews'])->middleware(['auth:sanctum', 'ability:dcm']);
Route::delete('/news/{id}', [NewsController::class, 'deleteNews'])->middleware(['auth:sanctum', 'ability:dcm']);


Route::post('/sending-key', [SendingKeyController::class, 'sendingKey'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::post('/permission-create', [PermissionController::class, 'permissionCreate'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/permission-list', [PermissionController::class, 'listPermission'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/permission/{id}', [PermissionController::class, 'getPermission'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::put('/permission-update/{id}', [PermissionController::class, 'updatePermission'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::delete('/permission-delete/{id}', [PermissionController::class, 'deletePermission'])->middleware(['auth:sanctum', 'ability:Admin']);

Route::post('/key-create', [KeyController::class, 'keyCreate'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/key-list', [KeyController::class, 'listKey'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/key/{id}', [KeyController::class, 'getKey'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::delete('/key-delete/{id}', [KeyController::class, 'deleteKey'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/key-permission-list', [KeyController::class, 'permissionKeyList'])->middleware(['auth:sanctum', 'ability:Admin']);

Route::get('/users', [UsersController::class, 'getAllUsers'])->middleware(['auth:sanctum', 'ability:Admin']);
Route::get('/user/{id}', [UsersController::class, 'getSingleUser'])->middleware(['auth:sanctum', 'ability:Admin']);
