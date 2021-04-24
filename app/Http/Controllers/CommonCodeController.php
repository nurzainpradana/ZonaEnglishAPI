<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CommonCodeController extends Controller
{
    // WEB ADMIN
    public function index()
    {
        $common_code = DB::table('tb_common_code')
            ->orderBy('hcode', 'ASC')
            ->orderBy('code', 'ASC')
            ->get();
        return view('commoncode/v_common_code', [
            'common_code' => $common_code
        ]);
    }

    public function create()
    {
        return view('commoncode/v_create_common_code');
    }

    public function saveCreate(request $request)
    {
        // Upload Attachment
        if ($request->file('remark_2') != null){
            $remark_2 = $request->file('remark_2');
            $remark_2_name = '';
            if ($remark_2 != null) {
                $filename = 'assets/icon/'.date("Y_m_d") . "_commoncode_" . $request->code . "_" . rand() . "_photo." . $remark_2->getClientOriginalExtension();
                $remark_2_name = url($filename);
                $destinationPath = public_path('assets/icon');
                $remark_2->move($destinationPath, $remark_2_name);
            }
            $commoncode = DB::table('tb_common_code')->insert([
                'hcode' => $request->hcode,
                'code' => $request->code,
                'name' => $request->name,
                'remark_1' => $request->remark_1,
                'remark_2' => $filename
            ]);
        } else {
            $commoncode = DB::table('tb_common_code')->insert([
                'hcode' => $request->hcode,
                'code' => $request->code,
                'name' => $request->name,
                'remark_1' => $request->remark_1
            ]);
        }
        if ($commoncode) {
            return redirect('commoncode');
        } else {
            return back();
        }
    }

    public function update($hcode, $code)
    {
        $data = DB::table('tb_common_code')
        ->where([['hcode', '=', $hcode], ['code', '=', $code]])
        ->first();

        return view('commoncode/v_update_common_code', ['data' => $data]);
    }

    public function saveUpdate(request $request)
    {
        $query = DB::table('tb_common_code')
            ->where('hcode', '=', $request->hcode)
            ->where('code', '=', $request->code)
            ->update([
                'name' => $request->name,
                'remark_1' => $request->remark_1,
                'remark_2' => $request->remark_2,
            ]);

        if ($query) {
            return redirect('commoncode');
        } else {
            return back();
        }
    }

    public function delete($hcode,$code)
    {
        $query = DB::table("tb_common_code")
            ->where('hcode', '=', $hcode)
            ->where('code', '=', $code)
            ->delete();

            // echo $query->remark_2."<br>";
            // echo File::delete($query->remark_2);
            // $exists = Storage::delete($query->remark_2);
            // echo $exists."<br>";

        // Menghapus Foto
        // if(file_exists($query->remark_2)){

        //     unlink($query->remark_2);
    
        //     $response["value"] = 1;
    
        //     $response["message"] = "Photo Berhasil Dihapus";
    
        // } else {
    
        //     $response["value"] = 2;
    
        //     $response["message"] = "Photo Tidak Ditemukan";
    
        // }

        // return response($response);  

        if ($query) {
            return redirect('commoncode');
        } else {
            return back();
        }
    }


    // API
    // Get Video Belajar List
    public function getTypeVideoList()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_common_code as ct')
                    ->where('hcode', '=', 'TY')
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
            'code' => 404,
            'data' => null
        ]);
    }

    // Get Video Belajar List
    public function getLevelList()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['api_token']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_common_code as ct')
                    ->where('hcode', '=', 'LV')
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
                        'code' => 204
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'failed',
                    'code' => 401
                ]);
            }
        }
        return response()->json([
            'message' => 'failed',
            'code' => 404
        ]);
    }

    // Get Video Belajar List
    public function getTitleList()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['title']) && $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_common_code')
                    ->where('hcode', '=', 'TTL')
                    ->where('code', '=', $_GET['type'])
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
                        'code' => 204
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'failed',
                    'code' => 401
                ]);
            }
        } else {
            $data = DB::table('tb_common_code')
                    ->where('hcode', '=', 'TTL')
                    ->where('code', '!=', '*')
                    ->get();

                    return response()->json([
                        'message' => 'success',
                        'code' => 200,
                        'data' => $data
                    ]);
        }
    }

    // Get Video List By Type
    public function getVideoListByTypeLevel()
    {
        if ($_GET != null) {
            // Verification API Token
            if (isset($_GET['type']) && isset($_GET['level'])&& $_GET['api_token'] == 'zonaenglish2021!') {
                $data = DB::table('tb_tutor')
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




    
}
