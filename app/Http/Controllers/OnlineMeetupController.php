<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OnlineMeetupController extends Controller
{
    //Get Online Meetup
    public function getOnlineMeetup()
    {
        //Verification API Token
        if ($_GET != null) {
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_common_code')
                        ->where('hcode', '=', 'OM')
                        ->where('code', '!=', '*')
                        ->get();
    
                if (!$data->isEmpty()) {
                    return response()->json([
                        'message' => 'success',
                        'code' => 200,
                        'data' => $data
                    ]);
                } else {
                    return response()->json([
                        'message' => 'failed',
                        'code' => 204,
                        'data' => null
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'failed',
                    'code' => 401,
                    'data' => null
                ]);
            }
        }
        return response()->json([
            'message' => 'failed',
            'code' => 401,
            'data' => null
        ]);
    }

    public function getListTutorVideo()
    {
        //Verification API Token
        if ($_GET != null) {
            if (isset($_GET['code']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_online_meetup')
                        ->select(DB::raw('*, fn_get_tutor(code) as code_tutor'))
                        ->get();

                if (!$data->isEmpty()) {
                    return response()->json([
                        'message' => 'success',
                        'code' => 200,
                        'data' => $data
                    ]);
                } else {
                    return response()->json([
                        'message' => 'failed',
                        'code' => 204,
                        'data' => null
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'failed',
                    'code' => 401,
                    'data' => null
                ]);
            }
        }
        return response()->json([
            'message' => 'failed',
            'code' => 401,
            'data' => null
        ]);
    }
	
	public function getOnlineMeetupByType() {
        if ($_GET != null) {
            if (isset($_GET['type']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_online_meetup')
                    ->join('tb_tutor', 'tb_online_meetup.tutor', 'tb_tutor.code')
                    ->select('tb_online_meetup.*', 'tb_tutor.name', 'tb_tutor.photo')
                    ->where('type', '=', $_GET['type'])
                    ->get();

                if (!$data->isEmpty()) {
                    return response()->json([
                        'message' => 'success',
                        'code' => 200,
                        'data' => $data
                    ]);
                } else {
                    return response()->json([
                        'message' => 'failed',
                        'code' => 204,
                        'data' => null
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'failed',
                    'code' => 401,
                    'data' => null
                ]);
            }
        }
        return response()->json([
            'message' => 'failed',
            'code' => 401,
            'data' => null
        ]);
    }
}
