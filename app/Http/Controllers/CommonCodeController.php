<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommonCodeController extends Controller
{
    // Get Data Common Code
    public function index() {
        $query = DB::table('tb_common_code as cc')->get();
        // return response()->json(['message' => 'success', 'data' => $query])->setCallback(Input::get('callback'));
        // return json_encode($query);
    }

    // Get Video Belajar List
    public function getTypeVideoList() {
        $data = DB::table('tb_common_code as ct')
        ->where('hcode','=','TYR')
        ->where('code','!=','*')
        ->get();

        if(!$data->isEmpty()){
            return response()->json(['message' => 'success', 
            'code' => 200,
            'data' => $data]);
        } else {
            return response()->json(['message' => 'failed',
            'code' => 204,
            'data' => $data]);
        }
    }
    
    // Get Level List
    public function getLevelList() {
        return DB::table('tb_common_code as cc')
        ->where('hcode','=','LV')
        ->where('hcode','!=','*')
        ->get();
    }

    // Get Video By Type
    public function getVideoByType() {
        $query = DB::table('tb_common_code')
        ->where('hcode','=','LV')
        ->where('hcode','!=','*')
        ->get();

        return json_encode($query);
    }

    public function create(request $request){
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

    public function update(request $request, $id) {
        $query = DB::table('tb_common_code')
        ->where('hcode','=',$request->hcode)
        ->update([
            'hcode' => $request->hcode,
            'code' => $request->code, 
            'name' => $request->name,
            'remark_1' => $request->remark_1,
            'remark_2' => $request->remark_2,
        ]);

        if($query) {
            return "Data berhasil di update";
        } else {
            return "Data gagal di update";
        }
    }

    public function delete($hcode){
        $query = DB::table("tb_common_code")
        -> where ('hcode','=',$hcode)
        ->delete();

        if($query) {
            return "Data berhasil dihapus";
        } else {
            return "Data gagal dihapus";
        }
    }


}
