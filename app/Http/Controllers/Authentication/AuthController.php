<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\ApiResponseErrorResource;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\LoginResponseResource;
use App\Http\Resources\UserResponseResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * User login
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return (new ApiResponseErrorResource([
                'code' => 401,
                'message' => 'Email or password does not match',
            ]));
        }

        $token = $user->createToken('access_token')->accessToken;

        $user->token = $token;

        return (new LoginResponseResource($user));

    }

    /**
     * user register
     */
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->token = $user->createToken('access_token')->accessToken;

        return (new LoginResponseResource($user));
    }

    /**
     * User logout
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->token()->revoke();

            return (new ApiResponseResource([
                'message' => 'Logged out successfully',
            ]));
        }

        return (new ApiResponseErrorResource([
            'code' => 401,
            'message' => 'Unauthorized',
        ]));

    }

    public function profile(){
        $user = Auth::guard('api')->user();

        return new UserResponseResource($user);

    }




}
