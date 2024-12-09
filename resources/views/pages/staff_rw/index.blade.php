@extends('layouts.main')

@section('title', 'Daftar Pegawai RW ' . $rw_id . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Pegawai RW {{ $rw_id }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar Pegawai RW {{ $rw_id }}</li>
                    </ol>
                </div>
                <!-- end breadcrumb -->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- begin content -->
    <div class="row">
        @if ($staffRws->count() > 0)
            @foreach ($staffRws as $staffRw)
                <div class="col-lg-3">
                    <div class="card border border-light-subtle">
                        <div class="card-body">
                            <div class="d-flex align-start mb-3">
                                <div class="flex-grow-1">
                                    @if ($staffRw->status == 1)
                                        <span class="badge badge-soft-success fs-6">Aktif</span>
                                    @else
                                        <span class="badge badge-soft-danger fs-6">Tidak Aktif</span>
                                    @endif
                                </div>

                            </div>
                            <div class="text-center mb-3"><img src="{{ asset('assets/images/default_profile.png') }}"
                                    alt="" class="avatar-sm rounded-circle border border-secondary-subtle">
                                <h6 class="font-size-15 mt-3 mb-1">{{ $staffRw->name }}</h6>
                                {{-- {{dd($staffRw->staffCategory)}} --}}
                                <p class="mb-0 text-muted">{{ $staffRw->staffCategory->name }}</p>
                            </div>
                            {{-- <div class="d-flex mb-3 justify-content-center gap-2 text-muted">
                        <div><i class="bx bx-map align-middle text-primary"></i> Louisiana</div>
                        <p class="mb-0 text-center"><i class="bx bx-money align-middle text-primary"></i> $38 / hrs</p>
                    </div>
                    <div class="hstack gap-2 justify-content-center"><span
                            class="badge badge-soft-secondary">Bootstrap</span><span
                            class="badge badge-soft-secondary">HTML</span><span
                            class="badge badge-soft-secondary">CSS</span></div> --}}
                            <div class="mt-4 pt-1">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('staff-rw.edit', ['id' => $staffRw->id]) }}"
                                            class="btn btn-primary w-100">Edit</a>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('staff-rw.delete', ['id' => $staffRw->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-12">
                <div class="alert alert-warning fade show">Belum ada pegawai di RW {{ $rw_id }}, silakan
                    tambahkan data melalui tombol di pojok kanan bawah.</div>
            </div>

        @endif
    </div>
    <!-- end content -->

    <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('staff-rw.add', ['rw_id' => $rw_id]) }}">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <!-- FAB add ends -->
@endsection

@section('script')
    <script>
        // Menambahkan SweetAlert konfirmasi hapus
        document.querySelectorAll('.btn-outline-danger').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form submit langsung

                const form = this.closest('form'); // Ambil form yang terdekat

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data Pegawai RW {{ $rw_id }} ini akan dihapus secara permanen.",
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
