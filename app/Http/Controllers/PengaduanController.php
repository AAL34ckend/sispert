<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::guard('user')->user();
        $listPengaduan = Pengaduan::query();

        if ($user) {
            $listPengaduan->where('id_user', $user->id_user);
        }

        if (Auth::guard('admin')->check() || Auth::guard('petugas')->check()) {
            $listPengaduan->with(['kategori', 'user']);
        }

        $listPengaduan = $listPengaduan->paginate(10);

        return view('pages.dashboard.pengaduan.index', [
            'listPengaduan' => $listPengaduan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listKategori = Kategori::query()->get();

        return view('pages.dashboard.pengaduan.create', [
            'listKategori' => $listKategori,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['string'],
            'konten' => ['string'],
            'lokasi' => ['string'],
            'bukti' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'id_kategori' => ['required', 'exists:t_kategori,id_kategori'],
        ]);

        $berkasBukti = null;
        $namaBukti = null;
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $sha256 = hash_file('sha256', $bukti->getRealPath());
            $extension = $bukti->extension();

            $fileName = $sha256 . '.' . $extension;

            Storage::disk('public')->putFileAs('bukti', $bukti, $fileName);

            $berkasBukti = 'bukti/' . $fileName;
            $namaBukti = $bukti->getClientOriginalName();
        }

        Pengaduan::query()->create([
            'id_kategori' => $request->input('id_kategori'),
            'id_user' => Auth::guard('user')->user()->id_user,
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'status' => 'terkirim',
            'lokasi' => $request->input('lokasi'),
            'berkas_bukti' => $berkasBukti,
            'nama_bukti' => $namaBukti,
        ]);

        return response()->json([
            'message' => 'Pengaduan berhasil dikirim',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::query()->findOrFail($id);

        return view('pages.dashboard.pengaduan.detail', [
            'pengaduan' => $pengaduan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengaduan = Pengaduan::query()->findOrFail($id);
        $listKategori = Kategori::query()->get();

        return view('pages.dashboard.pengaduan.edit', [
            'pengaduan' => $pengaduan,
            'listKategori' => $listKategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::query()->findOrFail($id);

        if ($pengaduan->status !== 'terkirim') {
            return redirect()->back();
        }

        $request->validate([
            'judul' => ['string'],
            'konten' => ['string'],
            'lokasi' => ['string'],
            'bukti' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ]);

        $fileName = null;
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti', $fileName);
        }

        Pengaduan::query()
            ->findOrFail($id)
            ->update([
                'id_kategori' => $request->input('id_kategori'),
                'judul' => $request->input('judul'),
                'konten' => $request->input('konten'),
                'lokasi' => $request->input('lokasi'),
                'bukti' => $fileName ?? null,
            ]);

        return response()->json([
            'message' => 'Pengaduan berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::query()->findOrFail($id);

        if ($pengaduan->status !== 'terkirim') {
            return response()->json(
                [
                    'message' =>
                        'Pengaduan tidak dapat dihapus karena sudah diproses. Silahkan buat pengaduan baru.',
                ],
                403
            );
        }

        Pengaduan::query()->where('id_pengaduan', $id)->delete();

        return response()->json([
            'message' => 'Pengaduan berhasil dihapus',
        ]);
    }
}
