<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProsesController extends Controller
{
    public function index(Request $request, $idPengaduan) {
        $pengaduan = Pengaduan::query()->findOrFail($idPengaduan);

        $pengaduan->load(['kategori', 'user']);

        return view('pages.dashboard.pengaduan.proses.index', [
            'pengaduan' => $pengaduan
        ]);
    }

    public function proses(Request $request, $idPengaduan)
    {
        Pengaduan::query()->findOrFail($idPengaduan);

        $status = $request->input('status');
        $request->validate([
            'status' => ['required', 'in:diproses,diterima,selesai,ditolak'],
            'balasan' => [Rule::requiredIf($status === 'ditolak'), 'string'],
        ]);

        Pengaduan::query()->where('id_pengaduan', $idPengaduan)->update([
            'status' => $request->input('status'),
            'balasan' => $request->input('balasan'),
        ]);

        return redirect()->back();

    }
}
