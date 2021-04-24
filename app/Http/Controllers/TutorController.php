<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    // WEB ADMIN
    public function index()
    {
        $query = DB::table('tb_tutor')
            ->orderBy('code', 'ASC')
            ->get();
        return view('tutor/v_tutor', [
            'data' => $query
        ]);
    }

    public function create()
    {
        return view('tutor/v_create_tutor');
    }

    public function saveCreate(request $request)
    {
        // Get Last Code
        $lastId = DB::table('tb_tutor')->where('code', 'like', 'TTR%')->select(DB::raw('max(code) as code'))->first();

        
        $photo = $request->file('photo');
        if ($photo != null) {
            $filename = 'assets/photo_tutor/'.date("Y_m_d") . "_tutor_" . $request->code . "_" . rand() . "_photo." . $photo->getClientOriginalExtension();
            $photo_name = url($filename);
            $destinationPath = public_path('assets/icon');
            $photo->move($destinationPath, $photo_name);
        }
        
        $query = DB::table('tb_tutor')->insert([
            'code' => ++$lastId->code,
            'name' => $request->name,
            'title' => $request->title,
            'country' => $request->country,
            'experience' => $request->experience,
            'experience_detail' => $request->experience_detail,
            'price' => $request->price,
            'discount' => $request->discount,
            'education' => $request->education,
            'interest' => $request->interest,
            'spoken' => $request->spoken,
            'video' => $request->video,
            'photo' => $photo_name,
            'rating' => 3.0,
        ]);

        if ($query) {
            return redirect('tutor');
        } else {
            return back();
        }
    }

    public function update($code)
    {
        $data = DB::table('tb_tutor')
            ->where('code', '=', $code)
            ->first();

        return view('tutor/v_update_tutor', ['data' => $data]);
    }

    public function saveUpdate(request $request)
    {
        $query = DB::table('tb_tutor')
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
            return redirect('tutor');
        } else {
            return back();
        }
    }

    public function delete($code)
    {
        $query = DB::table("tb_tutor")
            ->where('code', '=', $code)
            ->delete();

        if ($query) {
            return redirect('tutor');
        } else {
            return back();
        }
    }

    //API
    // Get Title List
    public function getTitleList()
    {
        $query = DB::table('tb_common_code')
            ->where('hcode', '=', 'TTL')
            ->where('code', '!=', '*')
            ->get();

        if (isset($_GET['selectedCode'])) {
            $data = "<option value=''>- Select Title -</option>";
            foreach ($query as $t) {
                $t->code == $_GET['selectedCode'] ? $check = 'selected' : $check = '';
                $data .= "<option value='" . $t->code . "' " . $check . " >" . $t->name . "</option>";
            }
            echo $data;
        } else {
            $data = "<option value=''>- Select Title -</option>";
            foreach ($query as $t) {
                $data .= "<option value='" . $t->code . "' >" . $t->name . "</option>";
            }
            echo $data;
        }
    }

    // Get Video List By Type
    public function getVideoDetail()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['code']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_tutor')
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
                $data .= "<option value='" . $t->code . "' " . $check . " >" . $t->name . $t->remark_1 . "</option>";
            }
            echo $data;
        } else {
            $data = "<option value=''>- Select Level -</option>";
            foreach ($levelList as $t) {
                $data .= "<option value='" . $t->code . "' >" . $t->name . $t->remark_1 . "</option>";
            }
            echo $data;
        }
    }
}
