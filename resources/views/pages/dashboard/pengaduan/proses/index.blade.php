@extends('layouts.dashboard')

@section('title', 'Proses Pengaduan')

@section('content')
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card shadow">
            <div class="card-body">
                <div>
                    <div class="text-lg font-weight-bold">Judul</div>
                    <div>{{ $pengaduan->judul }}</div>
                </div>
                <div class="mt-3">
                    <div class="text-lg font-weight-bold">Isi</div>
                    <div>{{ $pengaduan->konten }}</div>
                </div>
                <div class="mt-3">
                    <div class="text-lg font-weight-bold">Lokasi</div>
                    <div>{{ $pengaduan->lokasi }}</div>
                </div>
                <div class="mt-3">
                    <div class="text-lg font-weight-bold">Kategori</div>
                    <div>{{ $pengaduan->kategori->nama }}</div>
                </div>
                <div class="mt-3">
                    <div class="text-lg font-weight-bold">Bukti</div>
                    <div>
                        <img src="{{ asset('storage/' . $pengaduan->berkas_bukti) }}" alt="Bukti" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 mt-4 mt-xl-0">
        @if ($pengaduan->user)
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-lg font-weight-bold mb-2">Pelapor</div>
                <div class="p-3 border rounded-lg d-flex flex-column justify-content-center w-100 align-items-center">
                    <div class="form-group">
                        <div class="form-avatar">
                            @if ($pengaduan->user->foto_profil)
                                <img src="/storage/{{ $pengaduan->user->foto_profil }}" alt="{{ $pengaduan->user->nama }}" />
                            @endif
                        </div>
                    </div>

                    <h6 class="font-weight-bold">{{ $pengaduan->user->nama }}</h6>
                    <p>{{ $pengaduan->user->no_handphone }}</p>

                    <div class="d-flex" style="gap: 1rem;">
                        <div>
                            <h6 class="font-weight-bold">RT</h6>
                            <p class="mb-0">{{ $pengaduan->user->rt }}</p>
                        </div>
                        <div>
                            <h6 class="font-weight-bold">RW</h6>
                            <p class="mb-0">{{ $pengaduan->user->rw }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <div class="text-lg font-weight-bold mb-2">Status</div>
                @if ($pengaduan->status === 'terkirim')
                    <button class="btn btn-info w-100 mb-2" onclick="terimaPengaduan()">Terima Pengaduan</button>
                    <button class="btn btn-danger w-100" data-toggle="modal" data-target="#tolakModal">Tolak Pengaduan</button>
                @endif
                @if ($pengaduan->status === 'diterima')
                    <button class="btn btn-warning w-100" onclick="prosesPengaduan()">Proses Pengaduan</button>
                @endif
                @if ($pengaduan->status === 'ditolak')
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Ditolak!</h4>
                        <p class="mb-0">Pengaduan ini telah ditolak.</p>
                    </div>
                    <button class="btn btn-info w-100" onclick="terimaPengaduan()">Terima Ulang Pengaduan</button>
                @endif
                @if ($pengaduan->status === 'diproses')
                    <button class="btn btn-success w-100 mb-2" onclick="selesaikanPengaduan()">Selesaikan Pengaduan</button>
                    <button class="btn btn-danger w-100" data-toggle="modal" data-target="#tolakModal">Tolak Pengaduan</button>
                @endif
                @if ($pengaduan->status === 'selesai')
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Selesai!</h4>
                        <p class="mb-0">Pengaduan ini telah selesai diproses.</p>
                    </div>
                    <button class="btn btn-info w-100" onclick="terimaPengaduan()">Terima Ulang Pengaduan</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" onsubmit="submitTolakPengaduan(event)">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakModalLabel">Tolak Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Alasan</label>
                    <textarea class="form-control" rows="5" placeholder="Masukkan alasan penolakan" name="balasan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function terimaPengaduan() {
        Swal.fire({
            title: 'Terima Pengaduan',
            text: 'Apakah anda yakin ingin menerima pengaduan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/proses',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        status: 'diterima'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pengaduan berhasil diterima.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pengaduan gagal diterima.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }

    function prosesPengaduan() {
        Swal.fire({
            title: 'Proses Pengaduan',
            text: 'Apakah anda yakin ingin memproses pengaduan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/proses',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        status: 'diproses'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pengaduan berhasil diproses.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pengaduan gagal diproses.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }

    function selesaikanPengaduan() {
        Swal.fire({
            title: 'Selesaikan Pengaduan',
            text: 'Apakah anda yakin ingin menyelesaikan pengaduan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/proses',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        status: 'selesai'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pengaduan berhasil diselesaikan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pengaduan gagal diselesaikan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }

    function submitTolakPengaduan(e) {
        e.preventDefault();
        const balasan = $('[name="balasan"]').val();

        Swal.fire({
            title: 'Tolak Pengaduan',
            text: 'Apakah anda yakin ingin menolak pengaduan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}/proses',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        status: 'ditolak',
                        balasan: balasan
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pengaduan berhasil ditolak.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pengaduan gagal ditolak.',
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
