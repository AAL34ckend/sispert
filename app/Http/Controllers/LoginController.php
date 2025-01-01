<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request) {
        // Validasi input
        $request->validate([
            'no_handphone' => ['required'],
            'password' => ['required']
        ]);

        $noHandphone = $request->input('no_handphone');
        $password = $request->input('password');

        $admin = Admin::query()
            ->where('no_handphone', $noHandphone)
            ->first();
        $user = User::query()
            ->where('no_handphone', $noHandphone)
            ->first();
        $petugas = Petugas::query()
            ->where('no_handphone', $noHandphone)
            ->first();

        $isLogin = false;

        if ($admin) {
            $isLogin = Auth::guard('admin')->attempt([
                'no_handphone' => $noHandphone,
                'password' => $password
            ]);
        }

        if ($user) {
            $isLogin = Auth::guard('user')->attempt([
                'no_handphone' => $noHandphone,
                'password' => $password
            ]);
        }

        if ($petugas) {
            $isLogin = Auth::guard('petugas')->attempt([
                'no_handphone' => $noHandphone,
                'password' => $password
            ]);
        }

        if ($isLogin) {
            return response()->json([
                'message' => 'Login berhasil'
            ]);
        }

        return response()->json([
            'message' => 'Login gagal. No handphone atau password salah'
        ], 401);
    }
}
