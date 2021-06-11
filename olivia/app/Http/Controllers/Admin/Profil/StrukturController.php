<?php

namespace App\Http\Controllers\Admin\Profil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, File, Validator;

class StrukturController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        setTimeZone();
    }

    public function index()
    {
        //
    }

    public function getStrukturDataTable()
    {
        $data = DB::table('struktur_organisasi')
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-struktur" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->nama.'" class="btn-delete-struktur" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
          })
        ->rawColumns(['aksi'])
        ->make(true);
    }
    public function loadDataTable()
    {
        return view('datatable.strukturDataTable');
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
        $rules = array (
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->nama;
            $deskripsi = $request->deskripsi;
            $gambar = $request->file('gambar');
            $namaOriFile = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $filePath = "assets/image/struktur";
            $gambar->move($filePath, $fileName, "");

            $struktur = DB::table('struktur_organisasi')->insert([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'gambar' => $filePath.'/'.$fileName,
                'created_at' =>  \Carbon\Carbon::now()
            ]);

            if($struktur) {
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
        $data = DB::table('struktur_organisasi')->where('id', $id)->get();
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
        $gambar = $request->file('gambar');
        if($gambar != null) {
        $rules = array (
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|max:2000|mimes:jpg,jpeg,svg,png,gif'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->nama;
            $deskripsi = $request->deskripsi;
            $gambar = $request->file('gambar');
            $namaOriFile = $gambar->getClientOriginalName();
            $fileName = time().'_'.$namaOriFile;
            $filePath = "assets/image/struktur";
            $gambar->move($filePath, $fileName, "");

            $gambarHapus = DB::table('struktur_organisasi')->where('id', $id)->value('gambar');
            File::delete($gambarHapus);

            $struktur = DB::table('struktur_organisasi')->where('id', $id)->update([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'gambar' => $filePath.'/'.$fileName,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($struktur) {
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
            $nama = $request->nama;
            $deskripsi = $request->deskripsi;
            $rules = array (
                'nama' => 'required',
                'deskripsi' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);
              if($validator->passes()) {
                $struktur = DB::table('struktur_organisasi')->where('id', $id)->update([
                    'nama' => $nama,
                    'deskripsi' => $deskripsi,
                    'updated_at' =>  \Carbon\Carbon::now()
                ]);

                if($struktur) {
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
        $gambarPathHapus = DB::table('struktur_organisasi')->where('id', $id)->value('gambar');
        File::delete($gambarPathHapus);
        DB::table('struktur_organisasi')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
