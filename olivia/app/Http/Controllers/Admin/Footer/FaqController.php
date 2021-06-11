<?php

namespace App\Http\Controllers\Admin\Footer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables, Validator;

class FaqController
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

    public function getFAQDataTable()
    {
        $data = DB::table('faq')->orderby('id', 'desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-edit-faq" style="font-size: 18pt; text-decoration: none;" class="mr-3">
            <i class="fas fa-pen-square"></i>
            </a>';
            $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-delete-faq" style="font-size: 18pt; text-decoration: none; color:red;">
            <i class="fas fa-trash"></i>
            </a>';
            return $btn;
            })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function loadDataTable()
    {
        return view('datatable.faqDataTable');
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
            'tanya' => 'required',
            'jawab' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $tanya = $request->tanya;
            $jawab = $request->jawab;

            $faq = DB::table('faq')->insert([
                'pertanyaan' => $tanya,
                'jawaban' => $jawab,
                'status' => 'draft',
                'created_at' =>  \Carbon\Carbon::now()
            ]);

            if($faq) {
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
        $data = DB::table('faq')->where('id', $id)->get();
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
            'tanya' => 'required',
            'jawab' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $tanya = $request->tanya;
            $jawab = $request->jawab;

            $faq = DB::table('faq')->where('id', $id)->update([
                'pertanyaan' => $tanya,
                'jawaban' => $jawab,
                'updated_at' =>  \Carbon\Carbon::now()
            ]);

            if($faq) {
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
        DB::table('faq')->where('id', $id)->delete();
        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
