<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserFAQController
{
    public function __construct()
    {
        setTimeZone();
    }

    public function getFAQ()
    {
        $faq = DB::table('faq')->orderBy('id', 'desc')->get();
        $returnHTML = view('user.jobs.faqView')->with('faq', $faq)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function store(Request $request)
    {
        $rules = array (
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
          if($validator->passes()) {
            $nama = $request->name;
            $email = $request->email;
            $pertanyaan = $request->message;

            $tanya = DB::table('pertanyaan_user')->insert([
                'nama' => $nama,
                'email' => $email,
                'pertanyaan' => $pertanyaan,
                'status' => 0,
                'created_at' =>  \Carbon\Carbon::now()
            ]);
            if($tanya) {
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
