<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('petugas')->logout();

        return response()->json([
            'message' => 'Berhasil logout',
        ]);
    }
}
