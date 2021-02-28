<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommonCodeController extends Controller
{
    // WEB ADMIN
    public function commonCode()
    {
        $name = session('name');
        $role = session('role');

        $common_code = CommonCode::orderBy('hcode', 'ASC')
            ->orderBy('code', 'ASC')
            ->get();
        return view('commoncode/v_common_code', [
            'common_code' => $common_code,
            'name' => $name,
            'role' => $role
        ]);
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




    public function create(request $request)
    {
        $commoncode = DB::table('tb_common_code')->insert([
            'hcode' => $request->hcode,
            'code' => $request->code,
            'name' => $request->name,
            'remark_1' => $request->remark_1,
            'remark_2' => $request->remark_2
        ]);
        if ($commoncode) {
            return "Data Berhasil disimpan";
        } else {
            return "Data Gagal disimpan";
        }
    }

    public function update(request $request, $id)
    {
        $query = DB::table('tb_common_code')
            ->where('hcode', '=', $request->hcode)
            ->update([
                'hcode' => $request->hcode,
                'code' => $request->code,
                'name' => $request->name,
                'remark_1' => $request->remark_1,
                'remark_2' => $request->remark_2,
            ]);

        if ($query) {
            return "Data berhasil di update";
        } else {
            return "Data gagal di update";
        }
    }

    public function delete($hcode)
    {
        $query = DB::table("tb_common_code")
            ->where('hcode', '=', $hcode)
            ->delete();

        if ($query) {
            return "Data berhasil dihapus";
        } else {
            return "Data gagal dihapus";
        }
    }
}
