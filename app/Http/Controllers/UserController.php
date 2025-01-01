<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listUser = User::query()->get();

        return view('pages.dashboard.user.index', ['listUser' => $listUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'no_handphone' => [
                'required',
                'string',
                Rule::unique('t_user', 'no_handphone'),
                Rule::unique('t_admin', 'no_handphone'),
                Rule::unique('t_petugas', 'no_handphone'),
            ],
            'password' => ['required', 'string'],
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ]);

        $fotoProfil = null;
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

        User::query()->create([
            'id_user' => Str::uuid(),
            'nama' => $request->input('nama'),
            'no_handphone' => $request->input('no_handphone'),
            'password' => Hash::make($request->input('password')),
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
            'foto_profil' => $fotoProfil,
        ]);

        return response()->json(['message' => 'User berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::query()->findOrFail($id);

        return view('pages.dashboard.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);

        return view('pages.dashboard.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'no_handphone' => ['required', 'string'],
            'password' => ['nullable', 'string'],
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ]);

        $user = User::query()->findOrFail($id);
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
            ->where('id_user', '=', $id)
            ->update([
                'nama' => $request->input('nama'),
                'no_handphone' => $request->input('no_handphone'),
                'password' => $password,
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'foto_profil' => $fotoProfil,
            ]);

        return response()->json(['message' => 'User berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::query()->where('id_user', '=', $id)->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
