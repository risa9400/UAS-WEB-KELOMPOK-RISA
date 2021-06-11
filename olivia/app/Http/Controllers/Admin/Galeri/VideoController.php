<?php

namespace App\Http\Controllers\Admin\Galeri;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;

class VideoController 
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

    public function getVideoDataTable()
    {
        $data = DB::table('video')->orderBy('id', 'desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-video" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->nama.'" class="btn-delete-video" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
          })
          ->addColumn('url', function($row){
            $url = $row->video;
            $html = '<a href="'.$url.'" class="btn-edit-Foto" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            '.$url.'
            </a>';
            return $html;
          })
        ->rawColumns(['aksi','url'])
        ->make(true);
    }
    public function loadDataTable()
    {
        return view('datatable.videoDataTable');
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
            'video' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->nama;
            $video = $request->video;

            $video = DB::table('video')->insert([
                'nama' => $nama,
                'video' => $video,
                'created_at' =>  \Carbon\Carbon::now()
            ]);
            if($video) {
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
        $data = DB::table('video')->where('id', $id)->get();
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
        $rules = array (
            'nama' => 'required',
            'video' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->nama;
            $video = $request->video;

            $video = DB::table('video')->where('id', $id)->update([
                'nama' => $nama,
                'video' => $video,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);
            if($video) {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = DB::table('video')->where('id', $id)->delete();
        if($hapus) {
            return response()->json([
                'status' => 'deleted',
            ]);
        }
    }
}
