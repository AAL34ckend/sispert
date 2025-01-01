@extends('layouts.dashboard')

@section('title', 'Daftar Pengguna')

@section('actions')
    <a class="btn btn-primary" href="/dashboard/user/create">Tambah Pengguna</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 70px">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Handphone</th>
                            <th scope="col">RT</th>
                            <th scope="col">RW</th>
                            <th scope="col" style="width: 120px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $user)
                            <tr>
                                <td scope="row" data-label='Foto'>
                                    @if ($user->foto_profil)
                                        <img
                                            src="/storage/{{ $user->foto_profil }}"
                                            alt="{{ $user->nama }}"
                                            style="width: 50px; height: 50px; border-radius: 100px; object-fit: cover;"
                                        />
                                    @else
                                        -
                                    @endif
                                </td>
                                <td scope="row" data-label='Nama User'>{{ $user->nama }}</td>
                                <td scope="row" data-label='Nomor Handphone'>{{ $user->no_handphone }}</td>
                                <td scope="row" data-label='RT'>{{ $user->rt }}</td>
                                <td scope="row" data-label='RW'>{{ $user->rw }}</td>
                                <td scope="row">
                                    <a class="btn btn-warning" href="/dashboard/user/{{ $user->id_user }}/edit">
                                        <i class="fas fa-edit fa-xs"></i>
                                    </a>
                                    <button
                                        class="btn btn-danger"
                                        onclick="deleteUser('{{ $user->id_user }}')"
                                    >
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
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
    function deleteUser(id) {
        Swal.fire({
            title: 'Hapus Pengguna',
            text: 'Apakah Anda yakin ingin menghapus pengguna ini?',
            icon: 'error',
            confirmButtonText: 'Hapus',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard/user/${id}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function() {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pengguna berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Pengguna gagal dihapus',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                })
            }
        })
    }
</script>
@endsection
