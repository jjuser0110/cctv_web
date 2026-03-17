<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/eventRcv', 'ApiController@eventRcv')->name('eventRcv');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/change_password', [App\Http\Controllers\HomeController::class, 'change_password'])->name('change_password');
Route::get('/popup', function () {
    $message = Cache::get('message');
    $lastUpdate = Cache::get('last_update');

    return response()->json([
        'message' => $message,
        'time' => $lastUpdate ? $lastUpdate->timestamp : null
    ]);
});

