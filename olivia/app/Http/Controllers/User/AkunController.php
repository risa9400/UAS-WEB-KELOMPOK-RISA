<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AkunController
{
    public function __construct()
    {
        setTimeZone();
    }

    public function index()
    {
        $data = DB::table('lomba')->get();
        $berkas = DB::table('berkas')
            ->join('lomba', 'berkas.id_pilihan', '=', 'lomba.id')
            ->where('berkas.id_user', auth()->user()->id)
            ->select('berkas.*', 'lomba.nama_lomba')
            ->get();
        return view('user.auth.home', compact('data', 'berkas'));
    }

    public function simpanDataPeserta(Request $request)
    {
        $rules = [
            'namaTim' => 'required',
            'namaDosen' => 'required',
            'nidnDosen' => 'required',
            'nimKetua' => 'required',
            'namaInstitusi' => 'required',
            'ktmKetua' => 'required|max:2000|mimes:jpg,jpeg,png,pdf',
            'email' => 'required',
            'namaAnggota1' => 'required',
            'namaAnggota2' => 'required',
            'nimAnggota1' => 'required',
            'nimAnggota2' => 'required',
            'ktmAnggota1' => 'required|max:2000|mimes:jpg,jpeg,png,pdf',
            'ktmAnggota2' => 'required|max:2000|mimes:jpg,jpeg,png,pdf',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()) {
            // store ktm ketua
            $ktm = $request->file('ktmKetua');
            $namaOriFile = $ktm->getClientOriginalName();
            $fileName = 'ketua_'.$namaOriFile;
            $filePath = "assets/berkas".'/'.auth()->user()->id;
            $ktm->move($filePath, $fileName, "");
            //store ktm anggota 1
            $ktm1 = $request->file('ktmAnggota1');
            $namaKTM1 = $ktm1->getClientOriginalName();
            $fileNameKTM1 = 'anggota1_'.$namaKTM1;
            $filePathKTM1 = "assets/berkas".'/'.auth()->user()->id;
            $ktm1->move($filePathKTM1, $fileNameKTM1, "");
            //store ktm anggota 2
            $ktm2 = $request->file('ktmAnggota2');
            $namaKTM2 = $ktm2->getClientOriginalName();
            $fileNameKTM2 = 'anggota2_'.$namaKTM2;
            $filePathKTM2 = "assets/berkas".'/'.auth()->user()->id;
            $ktm2->move($filePathKTM2, $fileNameKTM2, "");
            
            $data = [
                'nama_team' => $request->namaTim ?? null,
                'nama_dosen' => $request->namaDosen ?? null,
                'nidn_dosen' => $request->nidnDosen ?? null,
                'nim_ketua' => $request->nimKetua ?? null,
                'institusi' => $request->namaInstitusi ?? null,
                'ktm_ketua' => $filePath.'/'.$fileName,
                'id_user' => auth()->user()->id,
                'created_at' =>  \Carbon\Carbon::now()
            ];
            $dataAnggota1 = [
                'nama' => $request->namaAnggota1 ?? null,
                'nim' => $request->nimAnggota1 ?? null,
                'ktm' => $filePathKTM1.'/'.$fileNameKTM1,
                'id_user' => auth()->user()->id,
                'created_at' =>  \Carbon\Carbon::now()
            ];
            $dataAnggota2 = [
                'nama' => $request->namaAnggota2 ?? null,
                'nim' => $request->nimAnggota2 ?? null,
                'ktm' => $filePathKTM2.'/'.$fileNameKTM2,
                'id_user' => auth()->user()->id,
                'created_at' =>  \Carbon\Carbon::now()
            ];
            $tim = DB::table('data_tim')->insert($data);
            $anggota = DB::table('data_peserta')->insert($dataAnggota1);
            $anggota = DB::table('data_peserta')->insert($dataAnggota2);
            if($tim && $anggota) {
                return response()->json([
                    'success' => true,
                    'error' => '',
                    'message' => ''
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'error' => 'validation_error',
            'message' => $validator->errors()->first()
        ]);
    }

    public function getDataPeserta()
    {
        $id = auth()->user()->id;
        $tim = DB::table('data_tim')->where('id_user', $id)->get();
        $anggota = DB::table('data_peserta')->where('id_user', $id)->get();
        if(count($tim) == 1 && count($anggota) > 0) {
            return response()->json([
                'success' => true,
                'data_tim' => $tim,
                'data_anggota' => $anggota
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data_tim' => '',
                'data_anggota' => ''
            ]);
        }
    }

    public function getDataLomba()
    {
        $data = DB::table('lomba')->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function storeBerkas(Request $request)
    {
        $rules = [
            'pilihan' => 'required',
            'bukti' => 'required|max:2000|mimes:jpg,jpeg,png,pdf',
            'proposal' => 'required|max:2000|mimes:pdf',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            //store bukti
            $bukti = $request->file('bukti');
            $namabukti = $bukti->getClientOriginalName();
            $fileNamebukti = 'bayar_'.$namabukti;
            $filePathbukti = "assets/berkas".'/'.auth()->user()->id;
            $bukti->move($filePathbukti, $fileNamebukti, "");
            //store proposal
            $proposal = $request->file('proposal');
            $namaproposal = $proposal->getClientOriginalName();
            $fileNameproposal = 'proposal_'.$namaproposal;
            $filePathproposal = "assets/berkas".'/'.auth()->user()->id;
            $proposal->move($filePathproposal, $fileNameproposal, "");
            $data = [
                'bukti' => $filePathproposal.'/'.$fileNameproposal,
                'proposal' => $filePathbukti.'/'.$fileNamebukti,
                'id_pilihan' => $request->pilihan,
                'id_user' => auth()->user()->id
            ];
            $simpan = DB::table('berkas')->insert($data);
            if($simpan) {
                return response()->json([
                    'success' => true,
                    'error' => '',
                    'message' => ''
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'error' => 'validation_error',
            'message' => $validator->errors()->first()
        ]);
    }
}
