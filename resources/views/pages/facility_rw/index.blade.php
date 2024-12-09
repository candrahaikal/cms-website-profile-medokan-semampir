@extends('layouts.main')

@section('title', 'Daftar Fasilitas ' . $rw->name . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Fasilitas {{ $rw->name }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar Fasilitas {{ $rw->name }}</li>
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

                    {{-- <h4 class="card-title">Daftar Fasilitas {{strtoupper($type)}} {{$id}}</h4> --}}

                    <p class="card-title-desc">
                        Berikut ini adalah tabel yang menunjukkan daftar Fasilitas {{ $rw->name }} yang ada di Kelurahan
                        Medokan Semampir.
                    </p>
                    
                    @if ($facilities->count() > 0)

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" data-colvis="[]">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $facility->name }}</td>
                                    <td><img src="{{ asset($facility->image) }}" alt="gambar" style="height: 250px"></td>
                                    <td class="text-truncate">{!! $facility->description !!}</td>
                                    <td>
                                        @if ($facility->status == 1)
                                            <span class="badge bg-success fs-6 p-2">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="data-small">
                                        <a href="{{ route('facility-rw.edit', ['id' => $facility->id]) }}"
                                            class="btn btn-success">Ubah</a>
                                        <form
                                            action="{{ route('facility-rw.delete', ['id' => $facility->id]) }}"
                                            method="POST" class="d-inline-block">
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
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                    @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">Belum ada data fasilitas di {{ $rw->name }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->


    <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('facility-rw.add', ['rw' => $rw->id]) }}">
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
                    text: "Data Fasilitas {{ $rw->name }} ini akan dihapus secara permanen.",
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
