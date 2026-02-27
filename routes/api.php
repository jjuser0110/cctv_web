<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/motiondetect', 'ApiController@motiondetect')->name('motiondetect');