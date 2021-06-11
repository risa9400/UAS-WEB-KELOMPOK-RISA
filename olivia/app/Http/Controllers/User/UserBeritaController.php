<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBeritaController
{
    public function index()
    {
        $data = DB::table('berita')->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'berita.id_penulis')
        ->select('berita.*', 'users.name')
        ->paginate(4);
        
        $latest = DB::table('berita')->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'berita.id_penulis')
        ->select('berita.*', 'users.name')
        ->paginate(8);
        return view('user.info.berita', compact('data', 'latest'));
    }

    public function show($id)
    {
        $data = DB::table('berita')
        ->where('berita.id', $id)
        ->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'berita.id_penulis')
        ->select('berita.*', 'users.name')
        ->get();
        return view('user.info.detailBerita', compact('data'));
    }

}
