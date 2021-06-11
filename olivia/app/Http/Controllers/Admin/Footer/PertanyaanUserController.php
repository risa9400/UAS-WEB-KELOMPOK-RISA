<?php

namespace App\Http\Controllers\Admin\Footer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Mail\OliviaMail;
use Illuminate\Support\Facades\Mail;

class PertanyaanUserController
{
    public function show($id)
    {
        $data = DB::table('pertanyaan_user')->where('id', $id)->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function loadDataTable()
    {
        return view('datatable.pertanyaanUserDataTable');
    }

    public function getAllPertanyaan(Request $request)
    {
        $status = $request->status;
        if($status == null) {
            $data = DB::table('pertanyaan_user')->orderby('id', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-hapus-pertanyaan" style="font-size: 18pt; text-decoration: none; color:red;" class="mr-3">
                <i class="fas fa-trash"></i>
                </a>';
                if($row->status == 1) {
                    $btn = $btn. '<button class="btn btn-success btn-close" type="button" id="btn-balas-pertanyaan" disabled>Jawab</button>';
                } else {
                    $btn = $btn. '<button data-id="'.$row->id.'" class="btn btn-success btn-close" type="button" id="btn-balas-pertanyaan">Jawab</button>';
                }
                return $btn;
                })
                ->addColumn('state', function($row){
                    $status = '';
                    if($row->status == 0) {
                    $status = 'Belum terjawab';
                    } else {
                        $status = 'Terjawab';
                    }
                    return $status;
                })
            ->rawColumns(['aksi', 'state'])
            ->make(true);
        } else if($status == "1") {
            $data = DB::table('pertanyaan_user')->where('status', 1)->orderby('id', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-hapus-pertanyaan" style="font-size: 18pt; text-decoration: none; color:red;" class="mr-3">
                <i class="fas fa-trash"></i>
                </a>';
                if($row->status == 1) {
                    $btn = $btn. '<button class="btn btn-success btn-close" type="button" id="btn-balas-pertanyaan" disabled>Jawab</button>';
                } else {
                    $btn = $btn. '<button class="btn btn-success btn-close" data-id="'.$row->id.'" type="button" id="btn-balas-pertanyaan">Jawab</button>';
                }
                return $btn;
                })
                ->addColumn('state', function($row){
                    $status = '';
                    if($row->status == 0) {
                    $status = 'Belum terjawab';
                    } else {
                        $status = 'Terjawab';
                    }
                    return $status;
                })
            ->rawColumns(['aksi', 'state'])
            ->make(true);
        } else {
            $data = DB::table('pertanyaan_user')->where('status', 0)->orderby('id', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-hapus-pertanyaan" style="font-size: 18pt; text-decoration: none; color:red;" class="mr-3">
                <i class="fas fa-trash"></i>
                </a>';
                if($row->status == 1) {
                    $btn = $btn. '<button class="btn btn-success btn-close" type="button" id="btn-balas-pertanyaan" disabled>Jawab</button>';
                } else {
                    $btn = $btn. '<button data-id="'.$row->id.'" class="btn btn-success btn-close" type="button" id="btn-balas-pertanyaan">Jawab</button>';
                }
                return $btn;
                })
                ->addColumn('state', function($row){
                    $status = '';
                    if($row->status == 0) {
                    $status = 'Belum terjawab';
                    } else {
                        $status = 'Terjawab';
                    }
                    return $status;
                })
            ->rawColumns(['aksi', 'state'])
            ->make(true);
        }
        
    }

    public function jawabPertanyaan(Request $request)
    {
        $penerima = $request->email;
        $nama = $request->nama;
        $pertanyaan = $request->pertanyaan;
        $jawaban = $request->jawaban;
        $id = $request->id;
        $data = array (
            'nama' => $nama,
            'pertanyaan' => $pertanyaan,
            'jawaban' => $jawaban
        );
        session(['email' => $data]);
        Mail::to($penerima)->send(new OliviaMail());
            $update = DB::table('pertanyaan_user')->where('id', $id)->update([
                'status' => 1
            ]);
            if($update) {
                return response()->json([
                    'status' => 'ok'
                ]);
            }

            return response()->json([
                'status' => 'no'
            ]);
    }
}
