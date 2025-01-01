@extends('layouts.dashboard')

@section('title', 'Ubah Kategori')

@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <form
                    action="/dashboard/kategori"
                    method="POST"
                    onsubmit="submitEditKategori(event)"
                >
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Kategori</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nama Kategori"
                            name="nama"
                            value="{{ $kategori->nama }}"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function submitEditKategori(e) {
        e.preventDefault()

        const nama = $('input[name="nama"]').val()

        $.ajax({
            url: '/dashboard/kategori/{{ $kategori->id_kategori }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                nama: nama
            },
            success: function (res) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Kategori berhasil disimpan',
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
