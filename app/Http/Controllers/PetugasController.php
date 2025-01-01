<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listPetugas = Petugas::query()->get();

        return view('pages.dashboard.petugas.index', ['listPetugas' => $listPetugas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['string'],
            'no_handphone' => ['string'],
            'password' => ['string'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $fotoProfil = null;
        if ($request->hasFile('foto_profil')) {
            $fotoProfil = $request->file('foto_profil');
            $sha256 = hash_file('sha256', $fotoProfil->getRealPath());
            $extension = $fotoProfil->getClientOriginalExtension();

            $fileName = $sha256 . '.' . $extension;
            Storage::disk('public')->putFileAs('foto_profil', $fotoProfil, $fileName);

            $fotoProfil = 'foto_profil/' . $fileName;
        }

        Petugas::query()->create([
            'id_petugas' => Str::uuid(),
            'nama' => $request->input('nama'),
            'no_handphone' => $request->input('no_handphone'),
            'password' => Hash::make($request->input('password')),
            'foto_profil' => $fotoProfil,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $petugas = Petugas::query()->findOrFail($id);

        return view('pages.dashboard.petugas.show', ['petugas' => $petugas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $petugas = Petugas::query()->findOrFail($id);

        return view('pages.dashboard.petugas.edit', ['petugas' => $petugas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => ['string'],
            'no_handphone' => ['string'],
            'password' => ['nullable', 'string'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $petugas = Petugas::query()->findOrFail($id);

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

            Storage::disk('public')->putFileAs('foto_profil', $fotoProfil, $fileName);

            $fotoProfil = 'foto_profil/' . $fileName;
        }

        $petugas->update([
            'nama' => $request->input('nama'),
            'no_handphone' => $request->input('no_handphone'),
            'password' => $password,
            'foto_profil' => $fotoProfil,
        ]);

        return response()->json(['message' => 'Petugas berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petugas = Petugas::query()->findOrFail($id);
        $petugas->delete();

        return response()->json(['message' => 'Petugas berhasil dihapus']);
    }
}
