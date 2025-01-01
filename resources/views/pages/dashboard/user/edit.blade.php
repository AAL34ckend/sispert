@extends('layouts.dashboard')

@section('title', 'Edit Pengguna')

@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <form action="/dashboard/user" method="POST" onsubmit="submitEditUser(event)">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Foto</label>
                        <div class="form-avatar">
                            <input type='file' hidden accept="image/*" name="foto_profil" />
                            @if ($user->foto_profil)
                                <img src="/storage/{{ $user->foto_profil }}" alt="{{ $user->nama }}" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Pengguna</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nama Pengguna"
                            name="nama"
                            required
                            value="{{ $user->nama }}"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nomor Telepon"
                            name="no_handphone"
                            required
                            value="{{ $user->no_handphone }}"
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Masukkan Password"
                            name="password"
                        />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">RT</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan RT"
                                    name="rt"
                                    required
                                    value="{{ $user->rt }}"
                                />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">RW</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan RW"
                                    name="rw"
                                    required
                                    value="{{ $user->rw }}"
                                />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan Pengguna
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function submitEditUser(e) {
        e.preventDefault()

        const nama = $('input[name="nama"]').val()
        const noHandphone = $('input[name="no_handphone"]').val()
        const password = $('input[name="password"]').val()
        const rt = $('input[name="rt"]').val()
        const rw = $('input[name="rw"]').val()
        const fotoProfil = $('input[name="foto_profil"]')[0].files?.[0];

        const formData = new FormData();
        formData.append('nama', nama);
        formData.append('no_handphone', noHandphone);
        password && formData.append('password', password);
        formData.append('rt', rt);
        formData.append('rw', rw);
        fotoProfil && formData.append('foto_profil', fotoProfil);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/dashboard/user/{{ $user->id_user }}',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Pengguna berhasil diubah',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    goBack()
                })
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Pengguna gagal diubah',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        })
    }
</script>
@endsection
