<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;

class PengumumanController
{   

    public function __construct()
    {
        setTimeZone();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getPengumumanDataTable()
    {
      $data = DB::table('pengumuman')->orderby('id', 'desc')->get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('aksi', function($row){
          $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-pengumuman" style="font-size: 18pt; text-decoration: none;" class="mr-3">
          <i class="fas fa-pen-square"></i>
          </a>';
          $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->judul.'" class="btn-delete-pengumuman" style="font-size: 18pt; text-decoration: none; color:red;">
          <i class="fas fa-trash"></i>
          </a>';
          return $btn;
        })
      ->rawColumns(['aksi'])
      ->make(true);
    }

    public function loadDataTable()
    {
        return view('datatable.pengumumanDataTable');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array (
            'judul' => 'required',
            'deskripsi' => 'required',
            'lampiran' => 'required|max:10000|mimes:jpg,jpeg,svg,png,gif,doc,docx,xlsx,xls,pdf',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $lampiran = $request->file('lampiran');
            $gambar = $request->file('gambar');
            $namaOriFile = $lampiran->getClientOriginalName();
            $namaOriFileGambar = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $fileNameGambar = time().'_'.$namaOriFileGambar;
            $filePath = "assets/file/pengumuman";
            $filePathGambar = "assets/image/pengumuman";
            $lampiran->move($filePath, $fileName, "");
            $gambar->move($filePathGambar, $fileNameGambar, "");

            $pengumuman = DB::table('pengumuman')->insert([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'lampiran' => $filePath.'/'.$fileName,
                'gambar' => $filePathGambar.'/'.$fileNameGambar,
                'id_user' => auth()->user()->id,
                'created_at' =>  \Carbon\Carbon::now()
            ]);

            if($pengumuman) {
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
        $data = DB::table('pengumuman')->where('id', $id)->get();
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
        $lampiran = $request->file('lampiran');
        $gambar = $request->file('gambar');
        if($lampiran != null && $gambar != null) {
        $rules = array (
            'judul' => 'required',
            'deskripsi' => 'required',
            'lampiran' => 'required|max:10000|mimes:jpg,jpeg,svg,png,gif,doc,docx,xlsx,xls,pdf',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $lampiran = $request->file('lampiran');
            $gambar = $request->file('gambar');
            $namaOriFile = $lampiran->getClientOriginalName();
            $namaOriFileGambar = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $fileNameGambar = time().'_'.$namaOriFileGambar;
            $filePath = "assets/file/pengumuman";
            $filePathGambar = "assets/image/pengumuman";
            $lampiran->move($filePath, $fileName, "");
            $gambar->move($filePathGambar, $fileNameGambar, "");

            $lampiranHapus = DB::table('pengumuman')->where('id', $id)->value('lampiran');
            File::delete($lampiranHapus);
            $gambarHapus = DB::table('pengumuman')->where('id', $id)->value('gambar');
            File::delete($gambarHapus);

            $pengumuman = DB::table('pengumuman')->where('id', $id)->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'lampiran' => $filePath.'/'.$fileName,
                'gambar' => $filePathGambar.'/'.$fileNameGambar,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($pengumuman) {
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
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $lampiran = $request->file('lampiran');
            $namaOriFile = $lampiran->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $filePath = "assets/file/pengumuman";
            $lampiran->move($filePath, $fileName, "");

            $lampiranHapus = DB::table('pengumuman')->where('id', $id)->value('lampiran');
            File::delete($lampiranHapus);

            $pengumuman = DB::table('pengumuman')->where('id', $id)->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'lampiran' => $filePath.'/'.$fileName,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($pengumuman) {
                return response()->json([
                    'status' => 'ok'
                  ]);
            }
        } else if($gambar != null) {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $gambar = $request->file('gambar');
            $namaOriFileGambar = $gambar->getClientOriginalName();
            $fileNameGambar = time().'_'.$namaOriFileGambar;
            $filePathGambar = "assets/image/pengumuman";
            $gambar->move($filePathGambar, $fileNameGambar, "");

            $gambarHapus = DB::table('pengumuman')->where('id', $id)->value('gambar');
            File::delete($gambarHapus);

            $pengumuman = DB::table('pengumuman')->where('id', $id)->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'gambar' => $filePathGambar.'/'.$fileNameGambar,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($pengumuman) {
                return response()->json([
                    'status' => 'ok'
                  ]);
            }

            return response()->json([
                'status' => 'validation_error',
                'message' => $validator->errors()->first()
              ]);
        } else {
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
            $rules = array (
                'judul' => 'required',
                'deskripsi' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);
              if($validator->passes()) {
                $pengumuman = DB::table('pengumuman')->where('id', $id)->update([
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);

                if($pengumuman) {
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
        $data = DB::table('pengumuman')->where('id', $id)->get();
        File::delete($data[0]->lampiran);
        File::delete($data[0]->gambar);
        DB::table('pengumuman')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
