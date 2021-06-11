<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;

class LombaController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home.lombaAdmin');
    }

    public function getLombaDataTable()
    {
        $data = DB::table('lomba')->orderBy('id', 'desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-lomba" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->nama_lomba.'" class="btn-delete-lomba" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
            })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function loadDataTable()
    {
        return view('datatable.lombaDataTable');
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
        $this->setTimeZone();
        $rules = array (
            'judul' => 'required',
            'deskripsi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'thumbnail' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif',
            'file' => 'required|max:10000|mimes:jpg,jpeg,svg,png,gif,doc,docx,ppt,pdf,xlsx'
        );
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()) {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $tglMulai = $request->tgl_mulai;
            $tglSelesai = $request->tgl_selesai;
            $thumbnail = $request->file('thumbnail');
            $lampiran = $request->file('file');
            $namaThumbnail = $thumbnail->getClientOriginalName();
            $namaLampiran = $lampiran->getClientOriginalName();

            $nameThumbnail = time().'_'.$namaThumbnail;
            $nameLampiran = time().'_'.$namaLampiran;

            $filePathThumbnail = "assets/image/lomba/thumbnail";
            $filePathLampiran = "assets/image/lomba/lampiran";

            $thumbnail->move($filePathThumbnail, $nameThumbnail, "public");
            $lampiran->move($filePathLampiran, $nameLampiran, "public");
            $jadwal = $tglMulai .'|'.$tglSelesai;

            $lomba = DB::table('lomba')->insert([
                'nama_lomba' => $judul,
                'deskripsi' => $deskripsi,
                'jadwal' => $jadwal,
                'thumbnail' => $filePathThumbnail.'/'.$nameThumbnail,
                'lampiran' => $filePathLampiran.'/'.$nameLampiran,
                'created_at' =>  \Carbon\Carbon::now()
            ]);
            if($lomba) {
                return response()->json([
                    'status' => 'ok'
                  ]);
            }
        }
        return response()->json([
            'status' => 'validation_error',
            'message' => $validator->errors()->first()
        ]);
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
        $data = DB::table('lomba')->where('id', $id)->get();
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->setTimeZone();
        $thumbnail = $request->file('thumbnail');
        $lampiran = $request->file('file');
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $tglMulai = $request->tgl_mulai;
        $tglSelesai = $request->tgl_selesai;

        if($thumbnail != null && $lampiran != null) {
            $rules = array (
                'judul' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'thumbnail' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif',
                'file' => 'required|max:10000|mimes:jpg,jpeg,svg,png,gif,doc,docx,ppt,pdf,xlsx'
            );
            
            $validator = Validator::make($request->all(), $rules);
            if($validator->passes()) {
                $namaThumbnail = $thumbnail->getClientOriginalName();
                $namaLampiran = $lampiran->getClientOriginalName();
    
                $nameThumbnail = time().'_'.$namaThumbnail;
                $nameLampiran = time().'_'.$namaLampiran;
    
                $filePathThumbnail = "assets/image/lomba/thumbnail";
                $filePathLampiran = "assets/image/lomba/lampiran";
    
                $thumbnail->move($filePathThumbnail, $nameThumbnail, "public");
                $lampiran->move($filePathLampiran, $nameLampiran, "public");
                //hapus di server
                $hapus = DB::table('lomba')->where('id', $id)->select('thumbnail','lampiran')->get();
                File::delete($hapus[0]->thumbnail);
                File::delete($hapus[0]->lampiran);
                $jadwal = $tglMulai .'|'.$tglSelesai;
    
                $lomba = DB::table('lomba')->where('id', $id)->update([
                    'nama_lomba' => $judul,
                    'deskripsi' => $deskripsi,
                    'jadwal' => $jadwal,
                    'thumbnail' => $filePathThumbnail.'/'.$nameThumbnail,
                    'lampiran' => $filePathLampiran.'/'.$nameLampiran,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);
                if($lomba) {
                    return response()->json([
                        'status' => 'ok'
                      ]);
                }
            }
            return response()->json([
                'status' => 'validation_error',
                'message' => $validator->errors()->first()
            ]);
        } else if($thumbnail != null) {
            $rules = array (
                'judul' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'thumbnail' => 'required|max:10000|mimes:jpg,jpeg,svg,png,gif',
            );
            
            $validator = Validator::make($request->all(), $rules);
            if($validator->passes()) {
                $namaThumbnail = $thumbnail->getClientOriginalName();
    
                $nameThumbnail = time().'_'.$namaThumbnail;
    
                $filePathThumbnail = "image/lomba/thumbnail";
                $thumbnailHapus = DB::table('lomba')->where('id', $id)->value('thumbnail');
                File::delete($thumbnailHapus);

                $thumbnail->move($filePathThumbnail, $nameThumbnail, "public");
                $jadwal = $tglMulai .'|'.$tglSelesai;
    
                $lomba = DB::table('lomba')->where('id', $id)->update([
                    'nama_lomba' => $judul,
                    'deskripsi' => $deskripsi,
                    'jadwal' => $jadwal,
                    'thumbnail' => $filePathThumbnail.'/'.$nameThumbnail,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);
                if($lomba) {
                    return response()->json([
                        'status' => 'ok'
                      ]);
                }
            }
            return response()->json([
                'status' => 'validation_error',
                'message' => $validator->errors()->first()
            ]);
        } else if($lampiran != null) {
            $rules = array (
                'judul' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'file' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif,doc,docx,ppt,pdf,xlsx',
            );
            
            $validator = Validator::make($request->all(), $rules);
            if($validator->passes()) {
                $namaLampiran = $lampiran->getClientOriginalName();
    
                $nameLampiran = time().'_'.$namaLampiran;
    
                $filePathLampiran = "image/lomba/lampiran";
                $lampiranHapus = DB::table('lomba')->where('id', $id)->value('lampiran');
                File::delete($lampiranHapus);
                
                $lampiran->move($filePathLampiran, $nameLampiran, "public");
                $jadwal = $tglMulai .'|'.$tglSelesai;
    
                $lomba = DB::table('lomba')->where('id', $id)->update([
                    'nama_lomba' => $judul,
                    'deskripsi' => $deskripsi,
                    'jadwal' => $jadwal,
                    'lampiran' => $filePathLampiran.'/'.$nameLampiran,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);
                if($lomba) {
                    return response()->json([
                        'status' => 'ok'
                      ]);
                }
            }
            return response()->json([
                'status' => 'validation_error',
                'message' => $validator->errors()->first()
            ]);
        } else {
            $rules = array (
                'judul' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);
            if($validator->passes()) {
                $jadwal = $tglMulai .'|'.$tglSelesai;
    
                $lomba = DB::table('lomba')->where('id', $id)->update([
                    'nama_lomba' => $judul,
                    'deskripsi' => $deskripsi,
                    'jadwal' => $jadwal,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);
                if($lomba) {
                    return response()->json([
                        'status' => 'ok'
                      ]);
                }
            }
            return response()->json([
                'status' => 'validation_error',
                'message' => $validator->errors()->first()
            ]);
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
        $hapus = DB::table('lomba')->where('id', $id)->select('thumbnail','lampiran')->get();
        File::delete($hapus[0]->thumbnail);
        File::delete($hapus[0]->lampiran);
        DB::table('lomba')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }

    function setTimeZone()
    {
        date_default_timezone_set("Asia/Jakarta");
    }
}
