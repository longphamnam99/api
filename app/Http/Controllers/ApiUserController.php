<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ApiLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ApiUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(ApiRegisterRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $saved = $user->save();

        if ($saved) {
            $res = [
                'code' => 200,
                'message' => 'ok',
            ];
            return response()->json($res);
        }

        $res = [
            'code' => 400,
            'message' => 'not ok',
        ];
        return response()->json($res);
    }

    public function refresh()
    {
        return $this->create_new_token(auth()->refresh());
    }

    protected function create_new_token($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

    public function login(ApiLoginRequest $request)
    {
        if (!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password,])) {
            $res = [
                'code' => 400,
                'message' => 'Incorrect account or password.',
            ];
            return response()->json($res);
        }

        $res = [
            'code' => 200,
            'message' => 'ok',
            'data' => [
                'token' => $this->create_new_token($token)['access_token']
            ]
        ];
        return response()->json($res);
    }

    public function logout()
    {
        Auth::logout();
        $res = [
            'code' => 200,
            'message' => 'ok'
        ];
        return response()->json($res);
    }

    public function info(request $request)
    {
        $user =  Auth::user();
        $data = [
            "introduction" => null,
            "avatar" => "https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif",
            "full_name" => $user["name"],
            "user_id" => $user["id"],
            "name" => $user["name"],
            "roles" => ["admin"]
        ];
        $res = [
            'code' => 200,
            'message' => 'ok',
            'data' => $data
        ];
        return response()->json($res);
    }
}
