@extends('layouts.main')

@section('title', 'Daftar RT | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar RT</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar RT</li>
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
                        Berikut ini adalah tabel yang menunjukkan daftar RT yang ada di <span
                            class="fw-bold">{{ $rw_id }}</span> di Kelurahan Medokan Semampir.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" data-colvis="[]">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>RW</th> --}}
                                <th>Nama</th>
                                <th>Jumlah Kepala Keluarga</th>
                                <th>Jumlah Penduduk</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rts as $rt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $rt->rw->name }}</td> --}}
                                    <td>{{ $rt->name }}</td>
                                    <td>{{ $rt->kk }}</td>
                                    <td>{{ $rt->population }}</td>
                                    @if ($rt->description == null)
                                        <td class="text-truncate">-</td>
                                    @else
                                        <td class="text-truncate" style="max-width: 200px"><p >{!! $rt->description !!}</p></td>
                                    @endif
                                    <td>
                                        @if ($rt->status == 1)
                                            <span class="badge bg-success fs-6 p-2">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="data-small">
                                        <a href="{{ route('rt.edit', ['id' => $rt->id]) }}" class="btn btn-success">Ubah</a>
                                        <form
                                            action="{{ route('rt.delete', ['rw_id' => $rw_id, 'id' => $rt->id]) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                {{-- <th>RW</th> --}}
                                <th>Nama</th>
                                <th>Jumlah Kepala Keluarga</th>
                                <th>Jumlah Penduduk</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

    <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('rt.add', ['rw_id' => $rw_id]) }}">
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
                    text: "Data RT ini akan dihapus secara permanen.",
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
