<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.profil.profil');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => ['string'],
            'no_handphone' => [
                'string',
                Rule::unique('t_user', 'no_handphone')->ignore(
                    Auth::guard('user')->check()
                        ? Auth::guard('user')->user()->id_user
                        : null,
                    'id_user'
                ),
                Rule::unique('t_admin', 'no_handphone')->ignore(
                    Auth::guard('admin')->check()
                        ? Auth::guard('admin')->user()->id_admin
                        : null,
                    'id_admin'
                ),
                Rule::unique('t_petugas', 'no_handphone')->ignore(
                    Auth::guard('petugas')->check()
                        ? Auth::guard('petugas')->user()->id_petugas
                        : null,
                    'id_petugas'
                ),
            ],
            'password' => ['nullable', 'string'],
            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'rt' => [Rule::requiredIf(Auth::guard('user')->check()), 'string'],
            'rw' => [Rule::requiredIf(Auth::guard('user')->check()), 'string'],
        ]);

        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            $password = $user->password;

            if ($request->has('password')) {
                $password = Hash::make($request->input('password'));
            }

            $fotoProfil = $user->foto_profil;
            if ($request->hasFile('foto_profil')) {
                $fotoProfil = $request->file('foto_profil');
                $sha256 = hash_file('sha256', $fotoProfil->getRealPath());
                $extension = $fotoProfil->getClientOriginalExtension();

                $fileName = $sha256 . '.' . $extension;

                Storage::disk('public')->putFileAs(
                    'foto_profil',
                    $fotoProfil,
                    $fileName
                );

                $fotoProfil = 'foto_profil/' . $fileName;
            }

            User::query()
                ->where('id_user', Auth::guard('user')->user()->id_user)
                ->update([
                    'nama' => $request->input('nama'),
                    'no_handphone' => $request->input('no_handphone'),
                    'password' => $password,
                    'foto_profil' => $fotoProfil,
                ]);
        }

        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $password = $admin->password;

            if ($request->has('password')) {
                $password = Hash::make($request->input('password'));
            }

            $fotoProfil = $admin->foto_profil;
            if ($request->hasFile('foto_profil')) {
                $fotoProfil = $request->file('foto_profil');
                $sha256 = hash_file('sha256', $fotoProfil->getRealPath());
                $extension = $fotoProfil->getClientOriginalExtension();

                $fileName = $sha256 . '.' . $extension;

                Storage::disk('public')->putFileAs(
                    'foto_profil',
                    $fotoProfil,
                    $fileName
                );

                $fotoProfil = 'foto_profil/' . $fileName;
            }

            Admin::query()
                ->where('id_admin', Auth::guard('admin')->user()->id_admin)
                ->update([
                    'nama' => $request->input('nama'),
                    'no_handphone' => $request->input('no_handphone'),
                    'password' => $password,
                    'foto_profil' => $fotoProfil,
                ]);
        }

        if (Auth::guard('petugas')->check()) {
            $petugas = Auth::guard('petugas')->user();
            $password = $petugas->password;

            if ($request->has('password')) {
                $password = Hash::make($request->input('password'));
            }

            $fotoProfil = $petugas->foto_profil;
            if ($request->hasFile('foto_profil')) {
                $fotoProfil = $request->file('foto_profil');
                $sha256 = hash_file('sha256', $fotoProfil->getRealPath());
                $extension = $fotoProfil->getClientOriginalExtension();

                $fileName = $sha256 . '.' . $extension;

                Storage::disk('public')->putFileAs(
                    'foto_profil',
                    $fotoProfil,
                    $fileName
                );

                $fotoProfil = 'foto_profil/' . $fileName;
            }

            Petugas::query()
                ->where(
                    'id_petugas',
                    Auth::guard('petugas')->user()->id_petugas
                )
                ->update([
                    'nama' => $request->input('nama'),
                    'no_handphone' => $request->input('no_handphone'),
                    'password' => $password,
                    'foto_profil' => $fotoProfil,
                ]);
        }

        return response()->json([
            'message' => 'Berhasil perbarui profil',
        ]);
    }
}
