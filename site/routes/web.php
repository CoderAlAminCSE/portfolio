<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@HomeIndex');
Route::post('/contactSend','HomeController@contactSend');


