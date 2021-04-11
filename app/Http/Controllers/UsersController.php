<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // WEB ADMIN
    public function index()
    {
        $query = DB::table('users')
            ->orderBy('id', 'ASC')
            ->get();

        return view('users/v_users', [
            'data' => $query
        ]);
    }

    public function create()
    {
        return view('users/v_create_users');
    }

    public function saveCreate(request $request)
    {
        $code = DB::table('users')->select(DB::raw('max(id) as code'))->first();

        // Upload Attachment
        if ($request->file('photo') != null){
            $picture = $request->file('photo');
            $picture_name = '';
            if ($picture != null) {
                $filename = 'public/assets/users/'.date("Y_m_d") . "_users_" . $request->code . "_" . rand() . "_photo." . $picture->getClientOriginalExtension();
                $picture_name = url($filename);
                $destinationPath = public_path('assets/users');
                $picture->move($destinationPath, $picture_name);
            }
            $users = DB::table('users')->insert([
                'id' => ++$code->code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_phone' => $request->no_phone,
                'nik' => $request->nik,
                'photo' => $picture_name
            ]);
        } else {
            $users = DB::table('users')->insert([
                'id' => ++$code->code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request->password),
                'no_phone' => $request->no_phone,
                'nik' => $request->nik
            ]);
        }
        if ($users) {
            return redirect('users');
        } else {
            return back();
        }
    }

    public function update($code)
    {
        $data = DB::table('users')
        ->where('id','=',$code)
        ->first();

        return view('users/v_update_users', ['data' => $data]);
    }

    public function saveUpdate(request $request)
    {
        if ($request->hasFile('photo') != null){
            $picture = $request->file('photo');
            $picture_name = '';
            if ($picture != null) {
                $filename = 'public/assets/users/'.date("Y_m_d") . "_users_" . $request->code . "_" . rand() . "_photo." . $picture->getClientOriginalExtension();
                $picture_name = $filename;
                $destinationPath = public_path('assets/users');
                $picture->move($destinationPath, $picture_name);
            }
            if (isset($request->password_new)) {
                $query = DB::table('users')
                ->where('id', '=', $request->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password_new),
                    'no_phone' => $request->no_photo,
                    'nik' => $request->nik,
                    'photo' => $picture_name
                ]);
            } else {
                $query = DB::table('users')
                ->where('id', '=', $request->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_phone' => $request->no_photo,
                    'nik' => $request->nik,
                    'photo' => $picture_name
                ]);
            }
            
        } else if (isset($request->picture_old)){
            if (isset($request->password_new)) {
                $query = DB::table('users')
                ->where('id', '=', $request->code)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password_new),
                    'no_phone' => $request->no_photo,
                    'nik' => $request->nik,
                    'photo' => $request->picture_old
                ]);
            } else {
                $query = DB::table('users')
                ->where('id', '=', $request->code)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_phone' => $request->no_photo,
                    'nik' => $request->nik,
                    'photo' => $request->picture_old
                ]);
            }
        } else {
            if (isset($request->password_new)) {
                $query = DB::table('users')
                ->where('id', '=', $request->code)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_phone' => $request->no_photo,
                    'password' => Hash::make($request->password_new),
                    'nik' => $request->nik
                ]);
            } else {
                $query = DB::table('users')
                ->where('id', '=', $request->code)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_phone' => $request->no_photo,
                    'nik' => $request->nik
                ]);
            }
        }

        // dd($query);

        if ($query) {
            return redirect('users');
        } else {
            return back();
        }
    }

    public function delete($code)
    {
        $query = DB::table('users')
            ->where('id', '=', $code)     
            ->delete();

        if ($query) {
            return redirect('users');
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
