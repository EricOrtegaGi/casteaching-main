<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Http\Controllers\UsersManageController;
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

// Login with Google Account routes

Route::get('/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');


Route::get('/', [LandingPageController::class, 'show']);

Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');
Route::get('/series/{seriesId}/videos/{videoId}', [SeriesController::class, 'showVideo'])->name('series.show.video');

Route::get('/videos/{id}', [VideosController::class,'show']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage/videos', [VideosManageController::class,'index'])->middleware(['can:videos_manage_index'])
        ->name('manage.videos');
    Route::post('/manage/videos', [VideosManageController::class,'store'])->middleware(['can:videos_manage_store']);
    Route::get('/manage/videos/{id}', [VideosManageController::class,'edit'])->middleware(['can:videos_manage_edit']);
    Route::put('/manage/videos/{id}', [VideosManageController::class,'update'])->middleware(['can:videos_manage_update']);
    Route::delete('/manage/videos/{id}', [VideosManageController::class,'destroy'])->middleware(['can:videos_manage_destroy']);

    Route::get('/manage/users', [ UsersManageController::class,'index'])->middleware(['can:users_manage_index'])
    ->name('manage.users');
    Route::post('/manage/users',[ UsersManageController::class,'store' ])->middleware(['can:users_manage_store']);
    Route::get('/manage/users/{id}/edit', [UsersManageController::class,'edit'])->middleware(['can:users_manage_edit'])->name('manage.users.edit');
    Route::put('/manage/users/{id}/edit', [UsersManageController::class,'update'])->middleware(['can:users_manage_update']);
    Route::delete('/manage/users/{id}',[ UsersManageController::class,'destroy' ])->middleware(['can:users_manage_destroy']);
    Route::get('/manage/users/{id}', [UsersManageController::class, 'show'])->middleware(['can:users_manage_show'])->name('manage.users.show');

    Route::get('/manage/series', [SeriesManageController::class, 'index'])->middleware(['can:series_manage_index'])->name('manage.series');
    Route::post('/manage/series', [SeriesManageController::class, 'store'])->middleware(['can:series_manage_store']);
    Route::delete('/manage/series/{id}', [SeriesManageController::class, 'destroy'])->middleware(['can:series_manage_destroy']);
    Route::get('/manage/series/{id}/edit', [SeriesManageController::class, 'edit'])->middleware(['can:series_manage_edit'])->name('manage.series.edit');
    Route::put('/manage/series/{id}', [SeriesManageController::class, 'update'])->middleware(['can:series_manage_update'])->name('manage.series.update');

});
