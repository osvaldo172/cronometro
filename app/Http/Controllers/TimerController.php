<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TimerController extends Controller
{
    public function storeTime(Request $request)
    {
        $time = $request->input('time');

        $fileName = 'times.txt';

        $date = Carbon::now();

        $filePath = storage_path('app/' . $fileName);
        $content = "Se guardo el tiempo: " . $time . " en la fecha $date \n";

        file_put_contents($filePath, $content, FILE_APPEND);

        return back()->with('success', 'El tiempo se ha registrado: ' . $time);
    }
}
