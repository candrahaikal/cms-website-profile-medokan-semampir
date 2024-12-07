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
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-start mb-3">
                        <div class="flex-grow-1"><span class="badge badge-soft-success">Full Time</span></div><button
                            type="button" class="btn btn-light btn-sm like-btn"><i class="bx bx-heart"></i></button>
                    </div>
                    <div class="text-center mb-3"><img src="/static/media/avatar-1.3921191a8acf79d3e907.jpg" alt=""
                            class="avatar-sm rounded-circle">
                        <h6 class="font-size-15 mt-3 mb-1">Steven Franklin</h6>
                        <p class="mb-0 text-muted">UI/UX Designer</p>
                    </div>
                    <div class="d-flex mb-3 justify-content-center gap-2 text-muted">
                        <div><i class="bx bx-map align-middle text-primary"></i> Louisiana</div>
                        <p class="mb-0 text-center"><i class="bx bx-money align-middle text-primary"></i> $38 / hrs</p>
                    </div>
                    <div class="hstack gap-2 justify-content-center"><span
                            class="badge badge-soft-secondary">Bootstrap</span><span
                            class="badge badge-soft-secondary">HTML</span><span
                            class="badge badge-soft-secondary">CSS</span></div>
                    <div class="mt-4 pt-1"><a class="btn btn-soft-primary d-block" href="/candidate-overview">View
                            Profile</a></div>
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
