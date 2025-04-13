<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.string' => 'Nama harus berupa string',

                'email.required' => 'Email harus diisi',
                'email.email' => 'Email harus berupa email valid',
                'email.unique' => 'Email sudah terdaftar',

                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
            ]
        );

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('relawan');

        DB::commit();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User registered successfully",
        ]);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string',
                'password' => 'required',
            ],
            [
                'email.required' => 'Nama harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new HttpException(401, 'Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User logged in successfully",
            "data" => [
                "token" => $token,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User logged out successfully",
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User data retrieved successfully",
            "data" => $request->user(),
        ]);
    }
}
