@extends('layouts.dashboard')

@section('title', 'Ubah Pengaduan')

@section('content')
<?php $disabled = $pengaduan->status != 'terkirim' ? 'disabled' : ''; ?>
<div class="row">
    <div class="col-12 col-xl-8 order-2 order-xl-1">
        <div class="card shadow">
            <div class="card-body">
                @if ($disabled)
                    <div class="alert alert-warning">
                        Pengaduan ini sudah tidak bisa diubah karena sudah diproses.
                    </div>
                @endif
                <form onsubmit="submitTambahPengaduan(event)">
                    <div class="form-group">
                        <label class="form-label">Judul</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Judul Pengaduan"
                            name="judul"
                            required
                            value="{{ $pengaduan->judul }}"
                            {{ $disabled }}
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Isi</label>
                        <textarea
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Isi Pengaduan"
                            name="konten"
                            rows="10"
                            required
                            {{ $disabled }}
                        >{{ $pengaduan->konten }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori" required {{ $disabled }}>
                            @foreach ($listKategori as $kategori)
                                <option
                                    value="{{ $kategori->id_kategori }}"
                                    {{ $kategori->id_kategori == $pengaduan->id_kategori ? 'selected' : '' }}
                                >{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <textarea
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Lokasi"
                            name="lokasi"
                            rows="3"
                            {{ $disabled }}
                        >{{ $pengaduan->lokasi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bukti Pengaduan</label>
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="customFile"
                                name="bukti"
                                onchange="changeFileLabel()"
                                {{ $disabled }}
                            >
                            <label class="custom-file-label" for="customFile">{{ $pengaduan->nama_bukti ?? '' }}</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" {{ $disabled }}>
                        Simpan Pengaduan
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if ($pengaduan->status !== 'terkirim')
    @guard(['user'])
        <div class="col-12 col-xl-4 mb-4 mb-xl-0 order-1 order-xl-2">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-xl font-weight-bold mb-2">Balasan</div>

                    @if ($pengaduan->status == 'diterima')
                        <div class="alert alert-info mb-0" role="alert">
                            <h4 class="alert-heading">Diterima!</h4>
                            <p class="mb-0">Pengaduan Anda sudah diterima. Silahkan tunggu proses selanjutnya.</p>
                        </div>
                    @endif
                    @if ($pengaduan->status == 'diproses')
                        <div class="alert alert-warning mb-0" role="alert">
                            <h4 class="alert-heading">Diproses!</h4>
                            <p class="mb-0">Pengaduan Anda sedang diproses.</p>
                        </div>
                    @endif
                    @if ($pengaduan->status == 'ditolak')
                        <div class="alert alert-danger mb-0" role="alert">
                            <h4 class="alert-heading">Ditolak!</h4>
                            <p>Pengaduan Anda ditolak.</p>
                            <hr />
                            <div class="font-weight-bold">Balasan</div>
                            <p class="mb-0">{{ $pengaduan->balasan }}</p>
                        </div>
                    @endif
                    @if ($pengaduan->status == 'selesai')
                        <div class="alert alert-success mb-0" role="alert">
                            <h4 class="alert-heading">Selesai!</h4>
                            <p class="mb-0">Selamat, pengaduan Anda sudah selesai.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endguard
    @endif
</div>
@endsection

@section('scripts')
<script>
    function changeFileLabel() {
        const fileInput = $('[name="bukti"]')[0];
        const label = $('.custom-file-label');
        const [file] = fileInput.files;

        if (!file) {
            label.text('Choose file');
            return;
        }

        label.text(fileInput.files[0].name);
    }

    function submitTambahPengaduan(e) {
        e.preventDefault();

        const judul = $('[name="judul"]').val();
        const konten = $('[name="konten"]').val();
        const kategori = $('[name="kategori"]').val();
        const lokasi = $('[name="lokasi"]').val();
        const bukti = $('[name="bukti"]')[0].files?.[0];

        const formData = new FormData();
        formData.append('judul', judul);
        formData.append('konten', konten);
        formData.append('id_kategori', kategori);
        formData.append('lokasi', lokasi);
        bukti && formData.append('bukti', bukti);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/dashboard/pengaduan/{{ $pengaduan->id_pengaduan }}',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                Swal.fire({
                    title: 'Berhasil',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    goBack();
                });
            },
            error: (xhr) => {
                const { errors, message } = xhr.responseJSON;

                setErrors(errors);

                Swal.fire({
                    title: 'Gagal',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

    }
</script>
@endsection
