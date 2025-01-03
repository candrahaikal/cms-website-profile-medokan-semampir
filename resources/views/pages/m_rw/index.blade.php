@extends('layouts.main')

@section('title', 'Daftar RW | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar RW</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar RW</li>
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

                    {{-- <h4 class="card-title">Company</h4> --}}
                    <p class="card-title-desc">
                        Berikut ini adalah tabel yang menunjukkan daftar RW yang ada di Medokan Semampir.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" data-colvis="[]">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rws as $rw)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rw->name }}</td>
                                    @if ($rw->description == null)
                                    <td class="text-truncate">-</td>
                                    @else

                                    <td class="text-truncate">{!! Str::limit($rw->description, 40) !!}</td>
                                    @endif
                                    <td>
                                        @if ($rw->status == 1)
                                            <span class="badge bg-success fs-6 p-2">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="data-small">
                                        <a href="{{ route('rw.edit', ['id' => $rw->id]) }}" class="btn btn-success">Ubah</a>
                                        <a href="{{ route('rt.index', ['rw_id' => $rw->id]) }}" class="btn btn-outline-primary">Detail RT</a>
                                        <form action="{{ route('rw.delete', ['id' => $rw->id]) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

    <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('rw.add') }}">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <!-- FAB add ends -->
@endsection

@section('script')
    <script>
        // Menambahkan SweetAlert konfirmasi hapus
        document.querySelectorAll('.btn-danger').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form submit langsung

                const form = this.closest('form'); // Ambil form yang terdekat

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `
        <p>Hal ini akan:</p>
        <ul class="text-start">
            <li>Menghapus seluruh data RW ini</li>
            <li>Menghapus seluruh data RT dalam RW ini</li>
            <li>Menghapus seluruh data pegawai dalam RW ini</li>
        </ul>
        <p class="text-danger"><strong>Tindakan ini tidak dapat dikembalikan.</strong></p>

    `,
                    icon: 'warning',
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
