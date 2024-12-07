@extends('layouts.main')

@section('title', 'Daftar Pegawai RT ' . ' ' . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Pegawai RT - {{ $rw->name }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar Pegawai RT - {{ $rw->name }}</li>
                    </ol>
                </div>
                <!-- end breadcrumb -->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- begin content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Daftar Pegawai RT di RW {{ $rwId }}</h4> --}}
                    <ul class="nav nav-pills nav-justified {{ $rts->count() <= 1 ? '' : 'mb-5' }}" role="tablist">
                        @if ($rts->count() > 1)

                            @foreach ($rts as $index => $rt)
                                <div class="col-lg-2">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                            href="#rt-{{ $rt->id }}" role="tab">
                                            {{ $rt->name }}
                                        </a>
                                    </li>
                                </div>
                            @endforeach
                        @elseif($rts->count() === 1)
                            <div class="row">
                                <div class="col-5 mb-5">
                                    {{-- <button class="btn btn-primary mb-5">{{ $rts->first()->name }}</button> --}}
                                    <li class="nav-item">
                                        <a class="nav-link active " data-bs-toggle="tab" href="#rt-{{ $rts->first()->id }}"
                                            role="tab">
                                            {{ $rts->first()->name }}
                                        </a>
                                    </li>
                                </div>
                            </div>
                            {{-- <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#rt-{{ $rts->first()->id }}"
                                    role="tab">
                                    {{ $rts->first()->name }}
                                </a>
                            </li> --}}
                        @else
                            <div class="col-12">
                                <div class="alert alert-warning text-center" role="alert">Belum ada RT di
                                    {{ $rw->name }}</div>
                            </div>

                        @endif
                    </ul>

                    {{-- <div class="card"> --}}
                    {{-- <div class="card-body"> --}}
                    <div class="tab-content">

                        {{-- <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('staff-rt.add', ['rt_id' => $rt->id]) }}" class="btn btn-primary">
                                Tambah Pegawai RT
                            </a>
                        </div> --}}

                        @foreach ($rts as $index => $rt)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="rt-{{ $rt->id }}"
                                role="tabpanel">
                                @if ($staffRts->has($rt->id))
                                    {{-- <div class="d-flex justify-content-between align-items-center mb-3"> --}}


                                    <!-- FAB add starts -->
                                    {{-- <div id="floating-add-button">
                                                    <a href="{{ route('staff-rt.add', ['rt_id' => $rt_id]) }}">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                </div> --}}
                                    <!-- FAB add ends -->
                                    {{-- </div> --}}

                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-9 col-12 mb-2 mb-md-0">
                                            <p class="card-title-desc mb-0">
                                                Berikut ini adalah tabel yang menunjukkan daftar pegawai <span
                                                    class="fw-bold">{{ $rt->name }}</span> di
                                                lingkup <span class="fw-bold">{{ $rt->rw->name }}</span> yang ada di
                                                kelurahan Medokan Semampir.
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-12 mb-2 mb-md-0">

                                            <div class="d-flex justify-content-end mb-2">
                                                <a href="{{ route('staff-rt.add', ['rt_id' => $rt->id]) }}"
                                                    class="btn btn-primary">
                                                    Tambah Pegawai RT
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        @foreach ($staffRts[$rt->id] as $staffRw)
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                <div class="card border border-secondary-subtle  shadow">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            @if ($staffRw->status == 1)
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
                                                            <h6 class="font-size-15 mt-3 mb-1">{{ $staffRw->name }}</h6>
                                                            <p class="mb-0 text-muted">{{ $staffRw->staffCategory->name }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a href="{{ route('staff-rt.edit', ['id' => $staffRw->id]) }}"
                                                                        class="btn btn-primary w-100">Edit</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <form
                                                                        action="{{ route('staff-rt.delete', ['rt_id' => $rt->id, 'id' => $staffRw->id]) }}"
                                                                        method="POST"
                                                                        id="delete-form-{{ $staffRw->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger w-100 btn-delete"
                                                                            data-id="{{ $staffRw->id }}"
                                                                            data-name="{{ $staffRw->name }}">
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
                                    </div>
                                @else
                                    <div class="d-flex justify-content-end mb-2">
                                        <a href="{{ route('staff-rt.add', ['rt_id' => $rt->id]) }}"
                                            class="btn btn-primary">
                                            Tambah Pegawai RT
                                        </a>
                                    </div>
                                    <div class="alert alert-warning text-center">Belum ada pegawai di <span
                                            class="fw-bold">{{ $rt->name }}</span></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    {{-- </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- end content -->

    {{-- <!-- FAB add starts -->
    <div id="floating-add-button">
        <a href="{{ route('staff-rt.add', ['rt_id' => $rt_id]) }}">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <!-- FAB add ends --> --}}
@endsection

@section('script')
    <script>
        // Seleksi semua tombol hapus berdasarkan kelas dan tambahkan event listener
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default tombol

                const id = this.getAttribute('data-id'); // Ambil ID dari atribut data-id
                const name = this.getAttribute('data-name'); // Ambil nama dari atribut data-name
                const form = document.getElementById(`delete-form-${id}`); // Seleksi form spesifik

                // SweetAlert konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Pegawai "${name}" akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika pengguna mengkonfirmasi
                    }
                });
            });
        });
    </script>
@endsection
