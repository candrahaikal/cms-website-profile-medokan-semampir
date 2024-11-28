@extends('layouts.main')

@section('title', 'Daftar Pegawai RT ' . $rt_id . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Pegawai RT {{$rt_id}}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Daftar Pegawai RT {{$rt_id}}</li>
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
                        This page presents a comprehensive overview of all available data, displayed in an interactive
                        and sortable DataTable format. Each row represents a unique data, providing key details such as
                        name, description, and status. Utilize the <b>column visibility, sorting, and column
                            search bar</b> features to
                        customize your view and quickly access the specific information you need.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" data-colvis="[]">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($staffRws as $staffRw)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $staffRw->name }}</td>
                                    <td>{{ $staffRw->staffCategory->name }}</td>
                                    <td>
                                        @if ($staffRw->status == 1)
                                            <span class="badge bg-success fs-6 p-2">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary fs-6 p-2">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="data-small">
                                        <a href="{{ route('staff-rt.edit', ['id'=>$staffRw->id]) }}" class="btn btn-success">Ubah</a>
                                        <form action="{{ route('staff-rt.delete', ['id'=>$staffRw->id, 'rt_id'=>$rt_id]) }}" method="POST" class="d-inline-block">
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
                                <th>Nama</th>
                                <th>Jabatan</th>
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
        <a href="{{ route('staff-rt.add', ['rt_id'=>$rt_id]) }}">
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
                text: "Data Pegawai RT {{$rt_id}} ini akan dihapus secara permanen.",
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