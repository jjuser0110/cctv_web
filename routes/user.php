<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->as('user.')->middleware(['auth'])->group(function() {
    Route::get('/index', 'UserController@index')->name('index');
    Route::get('/sync', 'UserController@sync')->name('sync');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/edit/{user}', 'UserController@edit')->name('edit');
    Route::post('/update/{user}', 'UserController@update')->name('update');
    Route::get('/destroy/{user}', 'UserController@destroy')->name('destroy');
});
