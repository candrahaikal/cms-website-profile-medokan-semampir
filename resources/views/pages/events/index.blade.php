@extends('layouts.main')

@section('title', 'Daftar Kegiatan - ' . $rw->name)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Daftar Kegiatan {{ $rw->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Utama</a></li>
                        <li class="breadcrumb-item active">Kegiatan</li>
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
                                @if ($events->has($rt->id) && $events[$rt->id]->count() > 0)
                                    <table class="table table-bordered dt-responsive nowrap w-100"
                                        id="table-rt-{{ $rt->id }}" data-colvis="[]" data-server-processing="false">
                                        <thead>
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
                                        </thead>
                                        <tbody>
                                            @foreach ($events[$rt->id] as $index => $event)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td class="w-25"><img src="{{ asset($event->image) }}" alt="gambar"
                                                            style="height: 250px"></td>
                                                    <td>{!! Str::limit($event->description, 50) !!}</td>
                                                    <td>{{ $event->date }}</td>
                                                    <td>{{ $event->location }}</td>
                                                    <td>
                                                        @if ($event->status == 1)
                                                                <span class="badge badge-soft-success fs-6">Aktif</span>
                                                            @else
                                                                <span class="badge badge-soft-danger fs-6">Tidak
                                                                    Aktif</span>
                                                            @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('event.edit', ['id' => $event->id]) }}"
                                                            class="btn btn-success">Ubah</a>
                                                        <form action="{{ route('event.delete', ['id' => $event->id]) }}"
                                                            method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Hapus</button>
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
                                                <th>Tangggal</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                @else
                                    <div class="alert alert-warning">Belum ada Kegiatan untuk {{ $rt->name }}.</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- FAB add starts -->
                    <div id="floating-add-button">
                        <a href="{{ route('event.add', ['rw' => $rw->id]) }}">
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
