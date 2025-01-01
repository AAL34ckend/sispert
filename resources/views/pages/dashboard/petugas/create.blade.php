@extends('layouts.dashboard')

@section('title', 'Tambah Petugas')

@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <form action="/dashboard/petugas" method="POST" onsubmit="submitTambahPetugas(event)">
                    <div class="form-group">
                        <label class="form-label">Foto</label>
                        <div class="form-avatar">
                            <input type='file' hidden accept="image/*" name="foto_profil" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Petugas</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nama Petugas"
                            name="nama"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nomor Telepon"
                            name="no_handphone"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Password"
                            name="password"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Tambah Petugas
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function submitTambahPetugas(e) {
        e.preventDefault()

        const nama = $('input[name="nama"]').val()
        const noHandphone = $('input[name="no_handphone"]').val()
        const password = $('input[name="password"]').val()
        const fotoProfil = $('input[name="foto_profil"]')[0].files[0];

        const formData = new FormData();
        formData.append('nama', nama);
        formData.append('no_handphone', noHandphone);
        formData.append('password', password);
        fotoProfil && formData.append('foto_profil', fotoProfil);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/dashboard/petugas',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Petugas berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    goBack()
                })
            },
            error: function (xhr) {
                setErrors(xhr.responseJSON.errors);

                Swal.fire({
                    title: 'Gagal',
                    text: xhr.responseJSON.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        })
    }
</script>
@endsection
