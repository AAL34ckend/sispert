<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listKategori = Kategori::query()->paginate(10);

        return view('pages.dashboard.kategori.index', [
            'listKategori' => $listKategori,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
        ]);

        Kategori::query()->create([
            'nama' => $request->input('nama'),
        ]);

        return response()->json(['message' => 'Kategori berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::query()->findOrFail($id);

        return view('pages.dashboard.kategori.show', ['kategori' => $kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::query()->findOrFail($id);

        return view('pages.dashboard.kategori.edit', ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Kategori::query()->findOrFail($id);
        $request->validate([
            'nama' => ['required', 'string'],
        ]);

        Kategori::query()
            ->where('id_kategori', '=', $id)
            ->update([
                'nama' => $request->input('nama'),
            ]);

        return response()->json(['message' => 'Kategori berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (
            Pengaduan::query()->where('id_kategori', '=', $id)->get()->count() >
            0
        ) {
            return response()->json([
                'message' =>
                    'Kategori tidak dapat dihapus karena sudah ada pengaduan di dalamnya',
                'status' => 403,
            ]);
        }

        Kategori::query()->where('id_kategori', '=', $id)->delete();

        return Response::json(['message' => 'Kategori berhasil dihapus']);
    }
}
