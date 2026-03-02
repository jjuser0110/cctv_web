<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/eventRcv', 'ApiController@eventRcv')->name('eventRcv');