@extends('layouts.dashboard')

@section('title', 'Daftar Petugas')

@section('actions')
    <a class="btn btn-primary" href="/dashboard/petugas/create">Tambah Petugas</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 70px;">Foto</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Nomor Handphone</th>
                            <th scope="col" style="width: 120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPetugas as $petugas)
                            <tr>
                                <td scope="row" data-label='Foto'>
                                    @if ($petugas->foto_profil)
                                        <img
                                            src="/storage/{{ $petugas->foto_profil }}"
                                            alt="{{ $petugas->nama }}"
                                            style="width: 50px; height: 50px; border-radius: 100px; object-fit: cover;"
                                        />
                                    @else
                                        -
                                    @endif
                                </td>
                                <td scope="row" data-label='Nama Petugas'>{{ $petugas->nama }}</td>
                                <td scope="row" data-label='Nomor Handphone'>{{ $petugas->no_handphone }}</td>
                                <td scope="row">
                                    <a class="btn btn-warning" href="/dashboard/petugas/{{ $petugas->id_petugas }}/edit">
                                        <i class="fas fa-edit fa-xs"></i>
                                    </a>
                                    <button
                                        class="btn btn-danger"
                                        onclick="deletePetugas('{{ $petugas->id_petugas }}')"
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
    function deletePetugas(id) {
        Swal.fire({
            title: 'Hapus Petugas',
            text: 'Apakah Anda yakin ingin menghapus petugas ini?',
            icon: 'error',
            confirmButtonText: 'Hapus',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard/petugas/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Petugas berhasil dihapus',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Gagal menghapus petugas',
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
