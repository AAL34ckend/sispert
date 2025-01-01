@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5 d-flex flex-column">
                                <img
                                    src="/img/logo.png"
                                    alt="Logo"
                                    style="width: 100px; height: 100px"
                                    class="mx-auto mb-4"
                                />
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Pendaftaran</h1>
                                </div>
                                <form class="user" onsubmit="submitRegistrasi(event)">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input
                                            type="text"
                                            name="nama"
                                            class="form-control form-control-user"
                                            placeholder="Masukkan Nama Lengkap"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nomor Handphone</label>
                                        <input
                                            type="text"
                                            name="no_handphone"
                                            class="form-control form-control-user"
                                            placeholder="Masukkan Nomor Handphone"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input
                                            type="text"
                                            placeholder="Masukkan Password"
                                            class="form-control form-control-user"
                                            name="password"
                                        />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">RT</label>
                                                <input
                                                    type="text"
                                                    placeholder="Masukkan RT"
                                                    class="form-control form-control-user"
                                                    name="rt"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">RW</label>
                                                <input
                                                    type="text"
                                                    placeholder="Masukkan RW"
                                                    class="form-control form-control-user"
                                                    name="rw"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    function submitRegistrasi(e) {
        e.preventDefault();

        const nama = $('[name="nama"]').val();
        const noHandphone = $('[name="no_handphone"]').val();
        const password = $('[name="password"]').val();
        const rt = $('[name="rt"]').val();
        const rw = $('[name="rw"]').val();

        $.ajax({
            url: '/auth/register',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nama: nama,
                rt: rt,
                rw: rw,
                no_handphone: noHandphone,
                password: password,
            },
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Registrasi berhasil. Silahkan login.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/auth/login';
                });
            },
            error: function (err) {
                Swal.fire({
                    title: 'Gagal',
                    text: err.responseJSON?.message || 'Terjadi kesalahan',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
</script>
@endsection
