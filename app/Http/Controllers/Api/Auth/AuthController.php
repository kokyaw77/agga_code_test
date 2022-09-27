<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|string|email|max:255',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => "fail",
            ], 422);
        }

        $data = $validator->validated();

        $user = $this->service->insertUser($data);

        $token = $user->createToken(env('APP_KEY'))->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
        ], 200);
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string'
        ]);

        if(auth()->attempt(['username' => $data['username'], 'password' => $data['password']])) {
            $user = auth()->user();
            $token = $user->createToken(env('APP_KEY'))->accessToken;
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                ],
                'token' => $token
            ], 202);
        }

        return response()->json(['status'=> false, 'message' => 'unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }
}
