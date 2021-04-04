<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoPromoController extends Controller
{
    // WEB ADMIN
    public function index()
    {
        $query = DB::table('tb_info_promo')
            ->orderBy('code', 'ASC')
            ->get();
        return view('infopromo/v_info_promo', [
            'info_promo' => $query
        ]);
    }

    public function create()
    {
        return view('infopromo/v_create_info_promo');
    }

    public function saveCreate(request $request)
    {
        $code = DB::table('tb_info_promo')->where('code','like','PRO%')->select(DB::raw('max(code) as code'))->first();

        // Upload Attachment
        if ($request->file('picture') != null){
            $picture = $request->file('picture');
            $picture_name = '';
            if ($picture != null) {
                $filename = 'assets/promo/'.date("Y_m_d") . "_promo_" . $request->code . "_" . rand() . "_photo." . $picture->getClientOriginalExtension();
                $picture_name = url($filename);
                $destinationPath = public_path('assets/promo');
                $picture->move($destinationPath, $picture_name);
            }
            $commoncode = DB::table('tb_info_promo')->insert([
                'code' => ++$code->code,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'sk' => $request->sk,
                'expired_date' => $request->expired_date,
                'picture' => $filename
            ]);
        } else {
            $commoncode = DB::table('tb_info_promo')->insert([
                'code' => ++$code->code,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'expired_date' => $request->expired_date,
                'sk' => $request->sk
            ]);
        }
        if ($commoncode) {
            return redirect('infopromo  ');
        } else {
            return back();
        }
    }

    public function update($code)
    {
        $data = DB::table('tb_info_promo')
        ->where('code','=',$code)
        ->first();

        return view('infopromo/v_update_info_promo', ['data' => $data]);
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

    // Get Video List By Type
    public function getInfoPromoList()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_info_promo')
                    ->where('expired_date', '>', date('Y-m-d'))
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
    public function getInfoPromoTopList()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_info_promo')
                    ->where('expired_date', '>', date('Y-m-d'))
                    ->orderBy('code', 'desc')
                    ->limit(3)
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
    public function getInfoPromoDetail()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!' && isset($_GET['code'])) {
                $data = DB::table('tb_info_promo')
                    ->where('code', '=', $_GET['code'])
                    ->first();

                // if (!$data->isEmpty()) {
                    return response()->json([
                        'message' => 'success',
                        'code' => 200,
                        'data' => $data
                    ]);
                // } else {
                //     return response()->json([
                //         'message' => 'failed',
                //         'code' => 204,
                //         'data' => null
                //     ]);
                // }
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
