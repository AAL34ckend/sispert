@extends('layouts.auth')

@section('title', 'Login')

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
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>
                                <form class="user" onsubmit="submitLogin(event)">
                                    @csrf
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
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
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
    function submitLogin(e) {
        e.preventDefault();

        const noHandphone = $('[name="no_handphone"]').val();
        const password = $('[name="password"]').val();

        $.ajax({
            url: '/auth/login',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                no_handphone: noHandphone,
                password: password,
            },
            success: function (res) {
                window.location.href = '/dashboard';
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
