@extends('layouts.main')

@section('title', 'Daftar Fasilitas RT -  ' . $rw->name)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Daftar Fasilitas {{ $rw->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Utama</a></li>
                        <li class="breadcrumb-item active">Fasilitas</li>
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
                        @foreach ($rts as $key => $rt)
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="rt-{{ $rt->id }}"
                                role="tabpanel" aria-labelledby="rt-tab-{{ $rt->id }}">
                                @if ($facilities->has($rt->id) && $facilities[$rt->id]->count() > 0)

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

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100"
                                        data-colvis="[]">
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
                                            @foreach ($facilities[$rt->id] as $index => $facility)
                                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $facility->name }}</td>
                                    <td class="w-25"><img src="{{ asset($facility->image) }}" alt="gambar"
                                            class="img-fluid"></td>
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
                                    <div class="alert alert-warning">Belum ada fasilitas untuk {{ $rt->name }}.
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
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
