<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPageController
{
    public function index()
    {
        $data = DB::table('lomba')->get();
        $slider = DB::table('slider')->get();
        $info = DB::table('info_grafis')->get();
        return view('user.index', compact('data', 'slider', 'info'));
    }

    public function profil()
    {
        $data = DB::table('visimisi')->get();
        return view('user.profil',compact('data'));
    }

    public function berita()
    {
        $data = DB::table('berita')->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'berita.id_penulis')
        ->select('berita.*', 'users.name')
        ->get();
        return view('user.info.berita', compact('data'));
    }

    public function pengumuman()
    {
        return view('user.info.pengumuman');
    }

    public function galeri()
    {
        return view('user.galeri');
    }

    public function faq()
    {
        return view('user.faq');
    }

    public function search(Request $request)
    {   
        $key = $request->key;
        // $data = DB::table('berita')->get();
        $berita = DB::table('berita')
        ->where('judul', 'LIKE', '%' .$key. '%')
        ->get();
        $pengumuman = DB::table('pengumuman')
        ->where('judul', 'LIKE', '%' .$key. '%')
        ->get();
        $lomba = DB::table('lomba')
        ->where('nama_lomba', 'LIKE', '%' .$key. '%')
        ->get();
        
        // dd($berita);
        // where('title', 'LIKE', '%' .'a'. '%')
        // ->gaginate4();
        if(count($berita) == 0 && count($pengumuman) == 0 && count($lomba) == 0) {
            $request->session()->flush();
            $returnHTML = view('user.jobs.searchNull')->render();
            return response()->json(array('success' => false, 'html'=>$returnHTML));
        }

            session(['berita' => $berita]);
            session(['pengumuman' => $pengumuman]);
            session(['lomba' => $lomba]);
            $returnHTML = view('user.jobs.search')->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        

    }
}
