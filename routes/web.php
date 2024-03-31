<?php

use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sendPodcastNotification/{id}', [PushNotificationController::class, 'sendFromPodcast'])->name('sendPodcastNotification');
Route::get('/sendNotification/{id}', [PushNotificationController::class, 'send'])->name('sendNotification');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
