<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimerController extends Controller
{
    public function __construct()
    {
        $time = '00:00:00';
        Storage::put('timer.txt', $time);

    }
    public function storeTime(Request $request)
    {
        $time = $request->input('time');

        $fileName = 'times.txt';

        $date = Carbon::now();

        $filePath = storage_path('app/' . $fileName);
        $content = "Se guardo el tiempo: " . $time . " en la fecha $date \n";

        file_put_contents($filePath, $content, FILE_APPEND);

        $time = '00:00:00';
        Storage::put('timer.txt', $time);

        return back()->with('success', 'El tiempo se ha registrado: ' . $time);
    }

    public function cronometro(){
        return view('cronometro');
    }

}
