@extends('layouts.dashboard')

@section('title', 'Daftar Kategori')

@section('actions')
    @guard(['admin', 'petugas'])
        <a class="btn btn-primary" href="/dashboard/kategori/create">Buat Kategori</a>
    @endguard
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Kategori</th>
                            @guard(['admin', 'petugas'])
                                <th scope="col" style="width: 120px"></th>
                            @endguard
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKategori as $kategori)
                            <tr>
                                <td scope="row" data-label='ID'>{{ $kategori->id_kategori }}</td>
                                <td scope="row" data-label='Nama Kategori'>{{ $kategori->nama }}</td>

                                @guard(['admin', 'petugas'])
                                    <td scope="row">
                                        <a class="btn btn-warning" href="/dashboard/kategori/{{ $kategori->id_kategori }}/edit">
                                            <i class="fas fa-edit fa-xs"></i>
                                        </a>
                                        <button
                                            class="btn btn-danger"
                                            onclick="deleteKategori({{ $kategori->id_kategori }})"
                                        >
                                            <i class="fas fa-trash fa-xs"></i>
                                        </button>
                                    </td>
                                @endguard
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $listKategori->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteKategori(id) {
        Swal.fire({
            title: 'Hapus Kategori',
            text: 'Apakah Anda yakin ingin menghapus kategori ini?',
            icon: 'error',
            confirmButtonText: 'Hapus',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'DELETE')
                fetch(`/dashboard/kategori/${id}`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Kategori berhasil dihapus',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                });
            }
        });
    }
</script>
@endsection
