<?php

namespace App\Http\Controllers\Api;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $count = $request->query('count', 10);
        $page = $request->query('page', 1);

        $users = User::paginate($count, ['*'], 'page', $page);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User retrieved successfully",
            "data" => $users->items(),
            "meta" => [
                "itemCounts" => $count,
                "currentPage" => $page,
                "totalItems" => $users->total(),
                "totalPages" => $users->lastPage(),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ],
            [
                'name.required' => 'Name harus diisi',
                'name.string' => 'Name harus berupa string',
                'name.unique' => 'Name sudah terdaftar',

                'email.required' => 'Email harus diisi',
                'email.email' => 'Email harus berupa email valid',
                'email.unique' => 'Email sudah terdaftar',

                'password.required' => 'Password harus diisi',
            ]
        );

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('surveyor');

        DB::commit();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User registered successfully",
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'name' => 'required|string|unique:users,name,' . $request->id,
                'email' => 'required|email|unique:users,email,' . $request->id,
                'password' => 'nullable|min:8',
            ],
            [
                'name.required' => 'Name harus diisi',
                'name.string' => 'Name harus berupa string',
                'name.unique' => 'Name sudah terdaftar',

                'email.required' => 'Email harus diisi',
                'email.email' => 'Email harus berupa email valid',
                'email.unique' => 'Email sudah terdaftar',

                'password.min' => 'Password minimal 8 karakter',
            ]
        );

        $user = User::whereId($request->id);

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        DB::beginTransaction();

        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        DB::commit();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "User updated successfully",
        ]);
    }
}
