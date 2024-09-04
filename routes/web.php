<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimerController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/store-time', [TimerController::class, 'storeTime'])->name('storeTime');
