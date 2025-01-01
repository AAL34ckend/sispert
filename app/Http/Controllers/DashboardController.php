<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('admin')->check() || Auth::guard('petugas')->check()) {
            $totalTerkirim = Pengaduan::query()->where('status', 'terkirim')->count();
            $totalDiterima = Pengaduan::query()->where('status', 'diterima')->count();
            $totalDiproses = Pengaduan::query()->where('status', 'diproses')->count();
            $totalSelesai = Pengaduan::query()->where('status', 'selesai')->count();
            $totalDitolak = Pengaduan::query()->where('status', 'ditolak')->count();

            $lineChartData = Pengaduan::query()
                ->toBase()
                ->select(DB::raw('COUNT(*) as total'), DB::raw('DATE(created_at) as tanggal'))
                ->where(DB::raw('DATE(created_at)'), '<=', DB::raw('CURDATE()'))
                ->where(DB::raw('DATE(created_at)'), '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 7 DAY)'))
                ->groupBy('tanggal')
                ->get();

            return view('pages.dashboard.index', [
                'totalTerkirim' => $totalTerkirim,
                'totalDiterima' => $totalDiterima,
                'totalDiproses' => $totalDiproses,
                'totalSelesai' => $totalSelesai,
                'totalDitolak' => $totalDitolak,
                'lineChartData' => $lineChartData->toJson(),
            ]);
        }

        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            $totalTerkirim = Pengaduan::query()->where('status', 'terkirim')->where('id_user', $user->id_user)->count();
            $totalDiterima = Pengaduan::query()->where('status', 'diterima')->where('id_user', $user->id_user)->count();
            $totalDiproses = Pengaduan::query()->where('status', 'diproses')->where('id_user', $user->id_user)->count();
            $totalSelesai = Pengaduan::query()->where('status', 'selesai')->where('id_user', $user->id_user)->count();
            $totalDitolak = Pengaduan::query()->where('status', 'ditolak')->where('id_user', $user->id_user)->count();

            $lineChartData = Pengaduan::query()
                ->toBase()
                ->select(DB::raw('COUNT(*) as total'), DB::raw('DATE(created_at) as tanggal'))
                ->where(DB::raw('DATE(created_at)'), '<=', DB::raw('CURDATE()'))
                ->where(DB::raw('DATE(created_at)'), '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 7 DAY)'))
                ->where('id_user', $user->id_user)
                ->groupBy('tanggal')
                ->get();

            return view('pages.dashboard.index', [
                'totalTerkirim' => $totalTerkirim,
                'totalDiterima' => $totalDiterima,
                'totalDiproses' => $totalDiproses,
                'totalSelesai' => $totalSelesai,
                'totalDitolak' => $totalDitolak,
                'lineChartData' => $lineChartData->toJson(),
            ]);
        }

        return view('pages.dashboard.index');
    }
}
