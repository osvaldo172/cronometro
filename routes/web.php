<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cronometro', [TimerController::class,'cronometro']);


Route::post('/store-time', [TimerController::class, 'storeTime'])->name('storeTime');

Route::get('/current-time', function (Request $request) {
    if (Storage::exists('timer.txt')) {
        $time = Storage::get('timer.txt'); // Leer el tiempo desde el archivo
    } else {
        $time = '00:00:00'; // Valor por defecto si el archivo no existe
    }
    return response()->json(['time' => $time]);
});

Route::post('/update-time', function (Request $request) {
    $time = $request->input('time');
    Storage::put('timer.txt', $time); // Guardar el tiempo en un archivo en storage/app
    return response()->json(['success' => true]);
});
