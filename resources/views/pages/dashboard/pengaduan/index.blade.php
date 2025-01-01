@extends('layouts.dashboard')

@section('title', 'Daftar Pengaduan')

@section('actions')
    @guard(['user'])
        <a class="btn btn-primary" href="/dashboard/pengaduan/create">Buat Pengaduan</a>
    @endguard
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body overflow-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @guard(['admin', 'petugas'])
                                <th scope="col">Pelapor</th>
                                <th scope="col" style="width: 100px">RT / RW</th>
                            @endguard
                            <th scope="col">Judul</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Balasan</th>
                            <th scope="col" style="width: 150px">Bukti</th>
                            <th scope="col" style="width: 90px">Status</th>
                            <th scope="col" style="width: 150px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPengaduan as $pengaduan)
                            <tr>
                                @guard(['admin', 'petugas'])
                                    <td scope="row" data-label='Pelapor'>{{ $pengaduan->user->nama }}</td>
                                    <td scope="row" data-label='RT / RW'>{{ $pengaduan->user->rt }} / {{ $pengaduan->user->rw }}</td>
                                @endguard
                                <td scope="row" data-label='Judul'>{{ $pengaduan->judul }}</td>
                                <td scope="row" data-label='Lokasi'>{{ $pengaduan->lokasi }}</td>
                                <td scope="row" data-label='Balasan'>{{ $pengaduan->balasan ?? '-' }}</td>
                                <td scope="row" data-label='Bukti'>
                                    <img src="/storage/{{ $pengaduan->berkas_bukti }}" alt="Bukti Pengaduan" style="max-width: 100px" />
                                </td>
                                <td scope="row" data-label='Status'>
                                    <span
                                        @class([
                                            'badge',
                                            'text-capitalize',
                                            'badge-primary' => $pengaduan->status === 'terkirim',
                                            'badge-info' => $pengaduan->status === 'diterima',
                                            'badge-success' => $pengaduan->status === 'selesai',
                                            'badge-danger' => $pengaduan->status === 'ditolak',
                                            'badge-warning' => $pengaduan->status === 'diproses',
                                        ])
                                    >{{ $pengaduan->status }}</span>
                                </td>
                                <td scope="row">
                                    @guard(['admin', 'petugas'])
                                        <a class="btn btn-primary" href="/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/proses">
                                            <i class="fa-solid fa-paper-plane fa-xs"></i>
                                        </a>
                                    @endguard
                                    @guard(['user'])
                                        <a class="btn btn-warning" href="/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/edit">
                                            <i class="fas fa-edit fa-xs"></i>
                                        </a>
                                    @endguard
                                    @guard(['user', 'admin'])
                                        <button
                                            class="btn btn-danger"
                                            onclick="deletePengaduan('{{ $pengaduan->id_pengaduan }}', '{{ $pengaduan->status }}')"
                                        >
                                            <i class="fas fa-trash fa-xs"></i>
                                        </button>
                                    @endguard
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deletePengaduan(id, status) {
        @guard(['user'])
            if (status !== 'terkirim') {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Pengaduan tidak dapat dihapus karena sudah dalam proses.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
        @endguard

        Swal.fire({
            title: 'Hapus Pengaduan',
            text: 'Apakah Anda yakin ingin menghapus pengaduan ini?',
            icon: 'error',
            confirmButtonText: 'Hapus',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard/pengaduan/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: (response) => {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: (xhr) => {
                        Swal.fire({
                            title: 'Gagal',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
</script>
@endsection
