<?php

namespace App\Http\Controllers\Admin\Galeri;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Auth, File, Validator;
class FotoController
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
        $data = DB::table('foto')->orderBy('id', 'desc')->get();
        return view('admin.galeri.fotoAdmin', compact('data'));
    }

    public function getFotoDataTable()
    {
        
        $data = DB::table('foto')
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-foto" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->nama.'" class="btn-delete-foto" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
          })
          ->addColumn('url', function($row){
            $url = $row->foto;
            $html = '<a href="'.$url.'" class="btn-edit-Foto" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            '.$url.'
            </a>';
            return $html;
          })
        
        ->rawColumns(['aksi'])
        ->make(true);
    }
    public function loadDataTable()
    {
        return view('datatable.FotoDataTable');
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
            'tahun' => 'required',
            'filename' =>'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
        );
        $validator = Validator::make($request->all(), $rules); 
        if($validator->passes()) {
            if($request->hasfile('filename'))
            {
                foreach($request->file('filename') as $image)
                {
                    $name=$image->getClientOriginalName();
                    $image->move(public_path().'/assets/image/galeri/foto/', $name);  // your folder path
                    $data[] = $name;  
                }
            }
            
            $foto = DB::table('foto')->insert([
                'nama' => $request->nama,
                'tahun' => $request->tahun,
                'foto' => json_encode($data),
                'created_at' =>  \Carbon\Carbon::now()
            ]);
            if($foto) {
                return back()->with('success', 'Image berhasil di upload');
            }
        }

        return back()->with('error', $validator->errors()->first());
        
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
        $data = DB::table('foto')->where('id', $id)->get();
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
        {
            $rules = array (
                'nama' => 'required',
                'tahun' => 'required',
                'filename' =>'required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
            );
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'tahun' => 'required',
                'filename' => 'required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
            ]);
            if($validator->passes()) {
                if($request->hasfile('filename'))
                {
                    foreach($request->file('filename') as $image)
                    {
                        $name=$image->getClientOriginalName();
                        $image->move(public_path().'/assets/image/galeri/foto/', $name);  // your folder path
                        $data[] = $name;  
                    }
                }
                
                $foto = DB::table('foto')->insert([
                    'nama' => $request->nama,
                    'tahun' => $request->tahun,
                    'foto' => json_encode($data),
                    'created_at' =>  \Carbon\Carbon::now()
                ]);
                if($foto) {
                    return back()->with('success', 'Image berhasil di upload');
                }
            }
    
            return back()->with('error', $validator->errors()->first());
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
    
            $hapus = DB::table('foto')->where('id', $id)->delete();
            if($hapus) {
                return back()->with('success', 'Image berhasil di upload');
            }
            return back()->with('error', $validator->errors()->first());
    }
}
