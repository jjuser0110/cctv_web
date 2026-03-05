<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/event')->as('event.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'EventController@index')->name('index');
});
