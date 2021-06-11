<?php

namespace App\Http\Controllers\Admin\Footer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;
class socialmediaController
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

    public function getSocialDataTable()
    {
        $data = DB::table('sosial_media')
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-socialmedia" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->nama.'" class="btn-delete-socialmedia" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
          })
        ->rawColumns(['aksi'])
        ->make(true);
    }
    public function loadDataTable()
    {
        return view('datatable.socialmediaDataTable');
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
            'url' => 'required',
            'icon' => 'required'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->nama;
            $url = $request->url;
            $icon = $request->icon;

            $social = DB::table('sosial_media')->insert([
                'nama' => $nama,
                'url' => $url,
                'icon' => $icon,
                'created_at' =>  \Carbon\Carbon::now()
            ]);

            if($social) {
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
        $data = DB::table('sosial_media')->where('id', $id)->get();
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
        $nama = $request->nama;
        $url = $request->url;
        $icon = $request->icon;
        $rules = array (
            'nama' => 'required',
            'url' => 'required',
            'icon' => 'required'
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            
            $social = DB::table('sosial_media')->where('id', $id)->update([
                'nama' => $nama,
                'url' => $url,
                'icon' => $icon,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($social) {
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
        DB::table('sosial_media')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
