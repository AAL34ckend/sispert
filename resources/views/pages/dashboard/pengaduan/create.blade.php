@extends('layouts.dashboard')

@section('title', 'Buat Pengaduan')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form onsubmit="submitTambahPengaduan(event)">
                    <div class="form-group">
                        <label class="form-label">Judul</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Judul Pengaduan"
                            name="judul"
                            required
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
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            @foreach ($listKategori as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama }}</option>
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
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bukti Pengaduan</label>
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="customFile"
                                name="bukti"
                                required
                                onchange="changeFileLabel()"
                            >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <button class="btn btn-primary">
                        Tambah Pengaduan
                    </button>
                </form>
            </div>
        </div>
    </div>
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
        const bukti = $('[name="bukti"]')[0].files[0];

        const formData = new FormData();
        formData.append('judul', judul);
        formData.append('konten', konten);
        formData.append('id_kategori', kategori);
        formData.append('lokasi', lokasi);
        formData.append('bukti', bukti);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/dashboard/pengaduan',
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
