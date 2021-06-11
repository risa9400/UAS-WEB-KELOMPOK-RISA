<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;

class BeritaController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getBeritaDataTable()
    {
      $data = DB::table('berita')
      ->get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('aksi', function($row){
          $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-berita" style="font-size: 18pt; text-decoration: none;" class="mr-3">
          <i class="fas fa-pen-square"></i>
          </a>';
          $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->judul.'" class="btn-delete-berita" style="font-size: 18pt; text-decoration: none; color:red;">
          <i class="fas fa-trash"></i>
          </a>';
          return $btn;
        })
      ->rawColumns(['aksi'])
      ->make(true);
    }

    public function loadDataTable()
    {
        return view('datatable.beritaDataTable');
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
            'keterangan' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $judul = $request->judul;
            $keterangan = $request->keterangan;
            $deskripsi = $request->deskripsi;
            $gambar = $request->file('gambar');
            $namaOriFile = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $filePath = "assets/image/berita";
            $gambar->move($filePath, $fileName, "");

            $berita = DB::table('berita')->insert([
                'judul' => $judul,
                'keterangan' => $keterangan,
                'deskripsi' => $deskripsi,
                'foto' => $filePath.'/'.$fileName,
                'id_penulis' => auth()->user()->id,
                'created_at' =>  \Carbon\Carbon::now()
            ]);
            if($berita) {
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
        $data = DB::table('berita')->where('id', $id)->get();
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
        $rules = array (
            'judul' => 'required',
            'keterangan' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        $judul = $request->judul;
        $keterangan = $request->keterangan;
        $deskripsi = $request->deskripsi;
        $gambar = $request->file('gambar');

        if($gambar != null) {
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            
            $namaOriFile = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $filePath = "assets/image/berita";
            $gambar->move($filePath, $fileName, "");
            //hapus file
            $gambarPathHapus = DB::table('berita')->where('id', $id)->value('foto');
            File::delete($gambarPathHapus);

            $berita = DB::table('berita')->where('id', $id)->update([
                'judul' => $judul,
                'keterangan' => $keterangan,
                'deskripsi' => $deskripsi,
                'foto' => $filePath.'/'.$fileName,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);
            if($berita) {
                return response()->json([
                    'status' => 'ok'
                  ]);
            }
          }
        } else {
            $rules2 = array (
                'judul' => 'required',
                'keterangan' => 'required',
                'deskripsi' => 'required',
            );
            $validator = Validator::make($request->all(), $rules2);
            if($validator->passes()) {
                $berita = DB::table('berita')->where('id', $id)->update([
                    'judul' => $judul,
                    'keterangan' => $keterangan,
                    'deskripsi' => $deskripsi,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);
                if($berita) {
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

          return response()->json([
            'status' => 'validation_error',
            'message' => $validator->errors()->first()
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambarPathHapus = DB::table('berita')->where('id', $id)->value('foto');
        File::delete($gambarPathHapus);
        DB::table('berita')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }

    function setTimeZone()
    {
        date_default_timezone_set("Asia/Jakarta");
    }
}
