<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use File;

class AkunController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')->where('id', auth()->user()->id)->get();
        return view('admin.akun', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $passwordLama = $request->password_lama;
        $passwordBaru = $request->password_baru;
        $passwordSekarang = auth()->user()->password;
        $nama = $request->nama;
        $gambar = $request->file('gambar');
        if($gambar) {
                    $namaOriFile = $gambar->getClientOriginalName();
                    $fileName = time().'_'.$namaOriFile;
                    $filePath = "assets/image/akun";
                    $gambar->move($filePath, $fileName);
                    //hapus file
                    $gambarPathHapus = DB::table('users')->where('id', auth()->user()->id)->value('gambar');
                    File::delete($gambarPathHapus);
                    try {
                        DB::table('users')->where('id', auth()->user()->id)->update(['gambar' => $filePath."/".$fileName]);
                        return response()->json([
                            'status' => 'ok'
                        ]);
                    } catch (\Throwable $th) {
                        return response()->json([
                            'status' => 'gagal'
                        ]);
                    }
        } else if($nama) {
            DB::table('users')->where('id', auth()->user()->id)->update(['name' => $nama]);
            return response()->json([
                'status' => 'ok'
            ]);
        } else if($passwordLama) {
        $cek = Hash::check($passwordLama, $passwordSekarang);
        if($cek) {
            $cekInput = DB::table('users')->where('id', auth()->user()->id)->update([
                'password' => Hash::make($passwordBaru)
            ]);
            if($cekInput) {
                return response()->json([
                    'status' => 'ok'
                ]);
            }
        }
        return response()->json([
            'status' => 'salah'
        ]);
        } else {
            //gambar
            $namaOriFile = $gambar->getClientOriginalName();
                    $fileName = time().'_'.$namaOriFile;
                    $filePath = "assets/image/akun";
                    $gambar->move($filePath, $fileName);
                    //hapus file
                    $gambarPathHapus = DB::table('users')->where('id', auth()->user()->id)->value('gambar');
                    File::delete($gambarPathHapus);
                    $cek = Hash::check($passwordLama, $passwordSekarang);
                    if($cek) {
                        $data = [
                            "gambar" => $filePath."/".$fileName,
                            "nama" => $nama,
                            "password" => Hash::make($passwordBaru)
                        ];
                        DB::table('users')->where('id', auth()->user()->id)->update($data);
                    }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
