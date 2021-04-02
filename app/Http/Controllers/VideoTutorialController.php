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
        $head_code = $request->type.$request->level;


        $lastId = DB::table('tb_video_tutorial')->where('code','like',$head_code.'%')->select(DB::raw('max(code) as code'))->first();

            $query = DB::table('tb_video_tutorial')->insert([
                'code' =>++$lastId->code,
                'type' => $request->type,
                'level' => $request->level,
                'title' => $request->title,
                'desc' => $request->description,
                'url_youtube' => $request->url_youtube,
                'url_zoom' => $request->url_zoom
            ]);
    
        if ($query) {
            return redirect('videotutorial');
        } else {
            return back();
        }
    }

    public function update($code)
    {
        $data = DB::table('tb_video_tutorial')
        ->where('code','=',$code)
        ->first();

        return view('videotutorial/v_update_video_tutorial', ['data' => $data]);
    }

    public function saveUpdate(request $request)
    {
        $query = DB::table('tb_video_tutorial')
            ->where('code', '=', $request->code)
            ->update([
                'type' => $request->type,
                'level' => $request->level,
                'title' => $request->title,
                'desc' => $request->description,
                'url_youtube' => $request->url_youtube,
                'url_zoom' => $request->url_zoom
            ]);

        if ($query) {
            return redirect('videotutorial');
        } else {
            return back();
        }
    }

    public function delete($code)
    {
        $query = DB::table("tb_video_tutorial")
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

    // Get Type List
    public function getTypeList()
    {
        $typeList = DB::table('tb_common_code')
        ->where('hcode', '=', 'TY')
        ->where('code', '!=', '*')
        ->get();

        if (isset($_GET['selectedCode'])) {
            $data = "<option value=''>- Select Type -</option>";
            foreach ($typeList as $t) {
                $t->code == $_GET['selectedCode'] ? $check = 'selected' : $check = '';
                $data .= "<option value='" . $t->code . "' " . $check . " >" . $t->name . "</option>";
            }
            echo $data;
        } else {
            $data = "<option value=''>- Select Type -</option>";
            foreach ($typeList as $t) {
                $data .= "<option value='" . $t->code . "' >" . $t->name . "</option>";
            }
            echo $data;
        }
    }

    // Get Level List
    public function getLevelList()
    {
        $levelList = DB::table('tb_common_code')
        ->where('hcode', '=', 'LV')
        ->where('code', '!=', '*')
        ->get();

        if (isset($_GET['selectedCode'])) {
            $data = "<option value=''>- Select Level -</option>";
            foreach ($levelList as $t) {
                $t->code == $_GET['selectedCode'] ? $check = 'selected' : $check = '';
                $data .= "<option value='" . $t->code . "' " . $check . " >" . $t->name . $t->remark_1 ."</option>";
            }
            echo $data;
        } else {
            $data = "<option value=''>- Select Level -</option>";
            foreach ($levelList as $t) {
                $data .= "<option value='" . $t->code . "' >" . $t->name . $t->remark_1 ."</option>";
            }
            echo $data;
        }
    }
}
