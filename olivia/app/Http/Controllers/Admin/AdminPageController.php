<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminPageController
{
    public function dashboard()
    {
        $user = DB::table('users')->count('id');
        $berita = DB::table('berita')->count('id');
        $lomba = DB::table('lomba')->count('id');
        $foto = DB::table('foto')->count('id');
        $video = DB::table('video')->count('id');
    	return view('admin.dashboard', compact('user', 'berita', 'lomba', 'foto', 'video'));
    }

    public function akun() 
    {
        return view('admin.akun');
    }
    public function berita()
    {
    	return view('admin.home.beritaAdmin');
    }

    public function artikel()
    {
    	return view('admin.artikel');
    }
    
    public function pengumuman()
    {
    	return view('admin.home.pengumuman');
    }

    public function sejarah()
    {
    	return view('admin.profil.sejarahAdmin');
    }
    public function visimisi()
    {
    	return view('admin.profil.visimisiAdmin');
    }
    public function struktur()
    {
        return view('admin.profil.strukturOrganisasi');
    }
    public function infoStruktur()
    {
        return view('admin.profil.infoStruktur');
    }
    public function tugasfungsi()
    {
        return view('admin.profil.tugasfungsiAdmin');
    }
     public function foto()
    {
        return view('admin.galeri.fotoAdmin');
    }
     public function video()
    {
        return view('admin.galeri.videoAdmin');
    }
     public function pertanyaan()
    {
        return view('admin.footer.pertanyaanAdmin');
    }
    public function faq()
    {
        return view('admin.footer.faqAdmin');
    }
    public function socialmedia()
    {
        return view('admin.footer.sosialmedia');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
