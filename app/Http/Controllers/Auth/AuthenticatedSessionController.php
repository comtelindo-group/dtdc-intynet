<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function register(){
        return view('pages.auth.register');
    }

    public function createAccount(Request $request){
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string'],
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
            ]);

            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ])->assignRole('relawan');

            DB::commit();

            return redirect('/login')->with('success', 'Account has been created!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            if (auth()->user()->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            } else if (auth()->user()->hasRole('relawan')) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            auth()->logout();
            return back()->with('error', 'Login Failed! Your account doesnt have access to this page.');
        }

        return back()->with('error', 'Login Failed! Email or Password is wrong.');
    }

    public function destroy(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
