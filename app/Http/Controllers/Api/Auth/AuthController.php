<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResgisterRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(ResgisterRequest $request)
    {
        try{
            $data = $request->validated();

            // Create new user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $request->role,
            ]);

            $token = $user->createToke('AccessToken')->accessToken;

            $data = ['access_token' => $token, 'user' => $user];

            return $this->successResponse($data, 'User registered successfully', 201);

        }catch(\Exception $e){
            \Log::error($e->getMessage());

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }
    }

    public function login(Request $request)
    {

        try{
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('AccessToken')->accessToken;

                $data = ['access_token' => $token, 'user' => $user];

                return $this->successResponse($data, 'User Logged in Successfully', 200);

            } else {
                $errorMessage = 'Invalid Credentials';
                return $this->errorResponse($errorMessage, 401);
            }

        }catch(\Exception $e){
            \Log::error($e->getMessage());

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('api')->user()->token()->revoke();

        return $this->errorResponse('User Logged out successfully', 200);
    }
}
