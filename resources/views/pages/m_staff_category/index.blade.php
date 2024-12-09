@extends('layouts.main')

@section('title', 'Daftar Kategori Jabatan | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Jenis Jabatan</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar Jenis Jabatan</li>
                    </ol>
                </div>
                <!-- end breadcrumb -->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- begin content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">
                        Berikut ini adalah tabel yang menunjukkan daftar Jenis Jabatan yang ada di Kelurahan Medokan Semampir.
                    </p>

                    <table id="sortable-table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sort</th>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mStaffCategories as $mStaffCategory)
                                <tr data-id="{{ $mStaffCategory->id }}">
                                    <td class="drag-handle">☰</td> <!-- Handle drag -->
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mStaffCategory->name }}</td>
                                    <td>
                                        @if ($mStaffCategory->status == 1)
                                            <span class="badge bg-success fs-6 p-2">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('staff-category.edit', ['id' => $mStaffCategory->id]) }}" class="btn btn-success">Ubah</a>
                                        <form action="{{ route('staff-category.delete', ['id' => $mStaffCategory->id]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <form id="csrf-form">
                        @csrf --}}
                        <button id="save-order" class="btn btn-primary mt-3">Simpan Urutan</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

    <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('staff-category.add') }}">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <!-- FAB add ends -->
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi SortableJS
    const sortable = new Sortable(document.querySelector('#sortable-table tbody'), {
        animation: 150,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
    });

    // Simpan urutan baru ke server
    document.getElementById('save-order').addEventListener('click', function (event) {
        event.preventDefault(); // Hindari submit langsung

        const order = [...document.querySelectorAll('#sortable-table tbody tr')].map(row => row.dataset.id);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!csrfToken) {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Token CSRF tidak ditemukan. Harap muat ulang halaman.',
            });
            return;
        }

        fetch('{{ route("staff-category.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ ids: order }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan koneksi.',
                });
                console.error('Error:', error);
            });
    });
});

</script>

<script>
    // Menambahkan SweetAlert konfirmasi hapus
    document.querySelectorAll('.btn-danger').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form submit langsung

            const form = this.closest('form'); // Ambil form yang terdekat

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data Kategori Jabatan ini akan dihapus secara permanen.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika konfirmasi "Ya, Hapus!"
                }
            });
        });
    });
</script>
@endsection
