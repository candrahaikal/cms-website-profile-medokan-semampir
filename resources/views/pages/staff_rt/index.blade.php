@extends('layouts.main')

@section('title', 'Daftar Pegawai - ' . $rw->name)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Daftar Pegawai {{ $rw->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Utama</a></li>
                        <li class="breadcrumb-item active">Pegawai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" id="rtTabs" role="tablist">
                        @foreach ($rts as $key => $rt)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="rt-tab-{{ $rt->id }}"
                                    data-bs-toggle="tab" href="#rt-{{ $rt->id }}" role="tab"
                                    aria-controls="rt-{{ $rt->id }}"
                                    aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                                    {{ $rt->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content mt-4" id="rtTabsContent">
                        <div id="loading-spinner" class="d-none text-center my-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        @foreach ($rts as $key => $rt)
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="rt-{{ $rt->id }}"
                                role="tabpanel" aria-labelledby="rt-tab-{{ $rt->id }}">
                                @if ($staffRts->has($rt->id) && $staffRts[$rt->id]->count() > 0)
                                
                                    {{-- <table class="table table-bordered dt-responsive nowrap w-100"
                                        id="table-rt-{{ $rt->id }}" data-colvis="[]" data-server-processing="false">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Deskripsi</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody> --}}
                                            @foreach ($staffRts[$rt->id] as $index => $staffRt)
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                <div class="card border border-secondary-subtle  shadow">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            @if ($staffRt->status == 1)
                                                                <span class="badge badge-soft-success fs-6">Aktif</span>
                                                            @else
                                                                <span class="badge badge-soft-danger fs-6">Tidak
                                                                    Aktif</span>
                                                            @endif
                                                        </div>
                                                        <div class="text-center mb-3">
                                                            <img src="{{ asset('assets/images/default_profile.png') }}"
                                                                alt="Profile Picture"
                                                                class="avatar-sm rounded-circle border border-secondary-subtle">
                                                            <h6 class="font-size-15 mt-3 mb-1">{{ $staffRt->name }}</h6>
                                                            <p class="mb-0 text-muted">{{ $staffRt->staffCategory->name }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a href="{{ route('staff-rt.edit', ['id' => $staffRt->id]) }}"
                                                                        class="btn btn-primary w-100">Edit</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <form
                                                                        action="{{ route('staff-rt.delete', ['rt_id' => $rt->id, 'id' => $staffRt->id]) }}"
                                                                        method="POST"
                                                                        id="delete-form-{{ $staffRt->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger w-100 btn-delete"
                                                                            data-id="{{ $staffRt->id }}"
                                                                            data-name="{{ $staffRt->name }}">
                                                                            Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        {{-- </tbody> --}}
                                        {{-- <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Deskripsi</th>
                                                <th>Tangggal</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot> --}}
                                    {{-- </table> --}}
                                @else
                                    <div class="alert alert-warning">Belum ada Pegawai untuk {{ $rt->name }}.</div>
                                @endif
                            </div>
                        @endforeach

                        
                    </div>
                    <!-- FAB add starts -->
                    <div id="floating-add-button">
                        <a href="{{ route('staff-rt.add', ['rw' => $rw->id]) }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <!-- FAB add ends -->
                </div>
            </div>
        </div>
    </div>
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
                    text: "Data ini akan dihapus secara permanen.",
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
