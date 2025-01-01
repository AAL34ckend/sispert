@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <form
                    action="/dashboard/kategori"
                    method="POST"
                    onsubmit="submitTambahKategori(event)"
                >
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Kategori</label>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan Nama Kategori"
                            name="nama"
                        />
                        {{-- <div class="invalid-feedback"></div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Tambah Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function submitTambahKategori(e) {
        e.preventDefault()

        const nama = $('input[name="nama"]').val()

        $.ajax({
            url: '/dashboard/kategori',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nama: nama
            },
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Kategori berhasil ditambahkan',
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
