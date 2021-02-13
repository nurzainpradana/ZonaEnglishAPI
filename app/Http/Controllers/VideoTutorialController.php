<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VideoTutorialController extends Controller
{
    
    // Get Video List By Type
    public function getVideoListByType()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['type']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_video_tutorial')
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
            'code' => 404,
            'data' => null
        ]);
    }

    // Get Video List By Type
    public function getVideoListByTypeLevel()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['type']) && isset($_GET['level'])&& $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_video_tutorial')
                    ->where('type', '=', $_GET['type'])
                    ->where('level', '=', $_GET['level'])
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
            'code' => 404,
            'data' => null
        ]);
    }

    // Get Video List By Type
    public function getVideoDetail()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['code']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_video_tutorial')
                    ->where('code', '=', $_GET['code'])
                    ->select(DB::raw('*, fn_get_level_name(level) as level_name, fn_get_type_video_name(type) as type_name'))
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
            'code' => 404,
            'data' => null
        ]);
    }
}
