<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //Register Tanpa Nomor telephone
    public function registerWithOutNoPhone(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:7'],
        ]);

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $accessToken = Auth::user()->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'meta' => [
                'token' => $accessToken
            ]
        ], Response::HTTP_CREATED);
    }

    //Register dengan no telephone
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:7'],
            'no_phone' => ['required', 'string']
        ]);

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $accessToken = Auth::user()->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'meta' => [
                'token' => $accessToken
            ]
        ], Response::HTTP_CREATED);
    }

    //Login Email
    public function loginEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $user
        ], Response::HTTP_CREATED);
    }

    //Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $accessToken = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'meta' => [
                'token' => $accessToken
            ]
        ], Response::HTTP_CREATED);
    }

    //Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout Success'
        ], Response::HTTP_OK);
    }

    // Update Name
    public function updateUser(Request $request)
    {
        $input = $request->all();
        $user = User::find($request->get('id'));

        if (is_null($user)) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($input, [
            'name' => 'sometimes',
            'photo' => 'sometimes|image|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $userPhoto = $request->file('photo');
                $extension = $userPhoto->getClientOriginalExtension();
                $userPhoto = "" . date('YmdHis') . "." . $extension;
                $uploadPath = env('UPLOAD_PATH') . "/users";
                $request->file('photo')->move($uploadPath, $userPhoto);

                $input['photo'] = $userPhoto;
            }
        }

        $user->update($input);
        return response()->json([
            'status' => true,
            'message' => 'Success update data'
        ]);
    }

    public function updateNoPhone(Request $request)
    {
        $input = $request->all();
        $user = User::find($request->get('id'));

        if (is_null($user)) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($input, [
            'no_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user->update($input);
        return response()->json([
            'status' => true,
            'message' => 'Success update data'
        ]);
    }
}
