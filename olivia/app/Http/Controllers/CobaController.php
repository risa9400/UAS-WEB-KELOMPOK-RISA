<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function coba()
    {
        $file = asset('tes.txt');
        $filePath = asset('tes');
        // $file->move($filePath, 'gambarName');
        return public_path('');
        // return view('coba');
    }
}
