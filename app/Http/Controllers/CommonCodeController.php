<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommonCodeController extends Controller
{
    // Get Data Common Code
    public function index() {
        $query = DB::table('tb_common_code as cc')->get();
        
        return json_encode($query);
        
    }

    // Get Video Belajar List
    public function getTypeVideo() {
        return DB::table('tb_common_code as cc')
        ->where('hcode','=','TY')
        ->where('hcode','!=','*')
        ->get();

    }
    
    // Get Level List
    public function getLevel() {
        return DB::table('tb_common_code as cc')
        ->where('hcode','=','LV')
        ->where('hcode','!=','*')
        ->get();
    }

    // Get Video By Type
    public function getVideoByType() {
        $query = DB::table('tb_common_code as cc')
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
