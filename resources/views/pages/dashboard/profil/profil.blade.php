@extends('layouts.dashboard')

@section('title', 'Profil Pengguna')

@section('content')
<?php $profil =
    Auth::guard('user')->user() ??
    (Auth::guard('admin')->user() ?? Auth::guard('petugas')->user()); ?>
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <form action="/dashboard/profil" method="POST" onsubmit="submitUpdateProfil(event)">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Foto</label>
                        <div class="form-avatar">
                            <input type='file' hidden accept="image/*" name="foto_profil" />
                            @if ($profil->foto_profil)
                                <img src="/storage/{{ $profil->foto_profil }}" alt="{{ $profil->nama }}" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nama"
                            name="nama"
                            value="{{ $profil->nama }}"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Handphone</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nomor Handphone"
                            name="no_handphone"
                            value="{{ $profil->no_handphone }}"
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
                    @guard(['user'])
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">RT</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Masukkan RT"
                                        name="rt"
                                        value="{{ $profil->rt }}"
                                    />
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">RW</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Masukkan RW"
                                        name="rw"
                                        value="{{ $profil->rw }}"
                                    />
                                </div>
                            </div>
                        </div>
                    @endguard

                    <button type="submit" class="btn btn-primary">
                        Perbarui Profil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function submitUpdateProfil(e) {
        e.preventDefault();

        const nama = $('input[name="nama"]').val();
        const noHandphone = $('input[name="no_handphone"]').val();
        const password = $('input[name="password"]').val();
        const rt = $('input[name="rt"]').val();
        const rw = $('input[name="rw"]').val();
        const fotoProfil = $('input[name="foto_profil"]')[0].files?.[0];

        const formData = new FormData();
        formData.append('nama', nama);
        formData.append('no_handphone', noHandphone);
        !!password && formData.append('password', password);
        formData.append('rt', rt);
        formData.append('rw', rw);
        !!fotoProfil && formData.append('foto_profil', fotoProfil);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/dashboard/profil',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil perbarui profil',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    goBack()
                })
            },
            error: function (xhr) {
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
