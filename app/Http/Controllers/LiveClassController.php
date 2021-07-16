<?php

namespace App\Http\Controllers;

use App\Http\Resources\LiveClassResource;
use App\LiveClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveClassController extends Controller
{
    public function getLiveClass(Request $request)
    {
//        $liveClass = LiveClass::all();
//        if (is_null($liveClass)) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Live class not found'
//            ], 404);
//        }

        return response()->json([
            'status' => true,
            'data' => [
                'liveclass' => 'new LiveClassResource($liveClass)'
            ]
        ]);
    }

    public function getLiveClassByType() {
		if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['type_class']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('live_classes')
                    ->join('tb_tutor', 'live_classes.tutor_code', '=', 'tb_tutor.code')
                    ->select('live_classes.*', 'tb_tutor.name', 'tb_tutor.photo')
                    ->where('type_class', '=', $_GET['type_class'])
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
