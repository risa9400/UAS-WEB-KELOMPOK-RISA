<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPengumumanController
{
    public function show($id)
    {
        $data = DB::table('pengumuman')->orderBy('id', 'desc')
        ->where('pengumuman.id', $id)
        ->join('users', 'users.id', '=', 'pengumuman.id_user')
        ->select('pengumuman.*', 'users.name')
        ->get();
        return view('user.info.detailPengumuman', compact('data'));
    }

    public function pengumuman()
    {   
        $data = DB::table('pengumuman')->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'pengumuman.id_user')
        ->select('pengumuman.*', 'users.name')
        ->paginate(4);
        $latest = DB::table('pengumuman')->orderBy('id', 'desc')
        ->join('users', 'users.id', '=', 'pengumuman.id_user')
        ->select('pengumuman.*', 'users.name')
        ->paginate(8);
        return view('user.info.pengumuman', compact('data', 'latest'));
    }
}
