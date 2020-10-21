<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getSuhu()
    {
        
    }

    public function store(Request $request) 
    {
        $rules = [
            'temperature' => 'required',
            'humidity' => 'required',
        ];
        $validatedData = Validator::make($request->all(), $rules);
        if($validatedData->passes()) {
            $data = [
                'temperature' => $request->temperature ?? null,
                'humidity' => $request->humidity ?? null,
                'nama_perangkat' => $request->nama_perangkat ?? null,
                'created_at' =>  \Carbon\Carbon::now()
            ];
            $store = DB::table('suhu')->insert($data);
            if($store) {
                return response()->json([
                    'success' => true,
                    'message' => 'sukses'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => $validatedData->errors()->first()
        ]);
        
    }
}
