<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        $user = new UserResource($result['user']);
        $token = $result['token'];

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request->validated());

        return response()->json([
            'message' => 'Logged in successfully.',
            'token' => $token
        ]);
    }

    // AuthController.php
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Logout failed.'], 500);
        }
    }
}
