<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController
{
    public function getSejarah()
    {
        $data = DB::table('sejarah')->where('status', 'aktif')->get();
        $returnHTML = view('user.jobs.profile.sejarahView')->with('data', $data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function index()
    {
        $data = DB::table('visimisi')->where('status', 'aktif')->get();
        $info = DB::table('info_struktur')->get();
        $struktur = DB::table('struktur_organisasi')->value('gambar');
        
        if(count($data) == 0 && count($info) == 0) {
            $data = null;
        } else if(count($data) == 0) {
            $data = null;
        }

        return view('user.profil',compact('data', 'info', 'struktur'));
    }

}
