<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //Get Schedule List
    public function getListSchedule()
    {
        if ($_GET != null) {
            //Verification API TOKEN
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_common_code as ct')
                        ->where('hcode', '=', 'SCTY')
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
        return response()->json([
            'message' => 'failed',
            'code' => 404,
            'data' => null
        ]);
    }
}
}
