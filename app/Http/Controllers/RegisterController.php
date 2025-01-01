<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'no_handphone' => ['required', Rule::unique('t_user', 'no_handphone'), Rule::unique('t_admin', 'no_handphone'), Rule::unique('t_petugas', 'no_handphone')],
            'password' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
        ]);

        User::query()->create([
            'id_user' => Str::uuid(),
            'nama' => $request->input('nama'),
            'no_handphone' => $request->input('no_handphone'),
            'password' => Hash::make($request->input('password')),
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
        ]);

        return response()->json([
            'message' => 'Berhasil mendaftar',
        ]);
    }
}
