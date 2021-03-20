<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VideoTutorialController extends Controller
{
    // WEB ADMIN
    public function index()
    {
        $query = DB::table('tb_video_tutorial')
            ->orderBy('code', 'ASC')
            ->get();
        return view('videotutorial/v_video_tutorial', [
            'video_tutorial' => $query
        ]);
    }

    public function create()
    {
        return view('videotutorial/v_create_video_tutorial');
    }

    public function saveCreate(request $request)
    {
        // Upload Attachment
        $remark_2 = $request->file('remark_2');
        $remark_2_name = '';
        if ($remark_2 != null) {
            $remark_2_name = 'assets/icon/'.date("Y_m_d") . "_video_tutorial_" . $request->code . "_" . rand() . "_photo." . $remark_2->getClientOriginalExtension();
            $destinationPath = public_path('assets/icon');
            $remark_2->move($destinationPath, $remark_2_name);
        }

        $query = DB::table('tb_video_tutorial')->insert([
            'hcode' => $request->hcode,
            'code' => $request->code,
            'name' => $request->name,
            'remark_1' => $request->remark_1,
            'remark_2' => $remark_2_name
        ]);
        if ($query) {
            return redirect('videotutorial');
        } else {
            return back();
        }
    }

    public function update($hcode, $code)
    {
        $data = DB::table('tb_video_tutorial')
        ->where([['hcode', '=', $hcode], ['code', '=', $code]])
        ->first();

        return view('videotutorial/v_update_video_tutorial', ['data' => $data]);
    }

    public function saveUpdate(request $request)
    {
        $query = DB::table('tb_video_tutorial')
            ->where('hcode', '=', $request->hcode)
            ->update([
                'hcode' => $request->hcode,
                'code' => $request->code,
                'name' => $request->name,
                'remark_1' => $request->remark_1,
                'remark_2' => $request->remark_2,
            ]);

        if ($query) {
            return redirect('videotutorial');
        } else {
            return back();
        }
    }

    public function delete($hcode,$code)
    {
        $query = DB::table("tb_video_tutorial")
            ->where('hcode', '=', $hcode)
            ->where('code', '=', $code)
            ->delete();

        if ($query) {
            return redirect('videotutorial');
        } else {
            return back();
        }
    }

    //API
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
