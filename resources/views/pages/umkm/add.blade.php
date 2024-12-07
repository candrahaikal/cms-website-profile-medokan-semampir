@extends('layouts.main')

@section('title', 'Tambah Data UMKM ' . $rw->name . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Data UMKM {{ $rw->name }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Tambah Data UMKM {{ $rw->name }}
                        </li>
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
                    {{-- <div class="h4 card-title">Silakan tambahkan data UMKM</div> --}}
                    <p class="card-title-desc">Tambahkan data fasilitas {{ $rw->name }} dengan melengkapi form di bawah
                        ini.
                    </p>

                    <form class="form" action="{{ route('umkm.store', ['rw' => $rw->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Field RT --}}
                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Pilih RT</label>
                            <div class="col-md-10">
                                <select class="form-control select2" name="rt" id="rt">
                                    <option disabled selected>Pilih RT...</option>
                                    @foreach ($rts as $rts)
                                        <option value="{{ $rts->id }}">{{ $rw->name }} - {{ $rts->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('rt'))
                                    <p class="text-danger mt-1">{{ $errors->first('rt') }}</p>
                                @endif

                            </div>
                        </div>
                        {{-- END Field RT --}}


                        <div class="mb-3 row">
                            <label for="nama" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" type="text" name="name"
                                    placeholder="Contoh: Ayam Geprek Mang Apoy">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="image" class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <input class="form-control" id="image" type="file" name="image">
                                @if ($errors->has('image'))
                                    <p class="text-danger mt-1">{{ $errors->first('image') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Deskripsi</label>

                            <div class="col-md-10">
                                <textarea name="description" id="description" cols="30" rows="10"
                                    placeholder="UMKM ini menjual makanan..."></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="contact" class="col-md-2 col-form-label">Contact</label>
                            <div class="col-md-10">
                                <input class="form-control" id="contact" type="text" name="contact"
                                    placeholder="Contoh: 0858598">
                                @if ($errors->has('contact'))
                                    <p class="text-danger mt-1">{{ $errors->first('contact') }}</p>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="link_maps" class="col-md-2 col-form-label">Link Google Maps</label>
                            <div class="col-md-10">
                                <input class="form-control" id="link_maps" type="text" name="link_maps"
                                    placeholder="https://g.co/kgs/BstkDC6">
                                @if ($errors->has('link_maps'))
                                    <p class="text-danger mt-1">{{ $errors->first('link_maps') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="link_order" class="col-md-2 col-form-label">Link Order</label>
                            <div class="col-md-10">
                                <input class="form-control" id="link_order" type="text" name="link_order"
                                    placeholder="Contoh: Link Shopeefood atau Gofood">
                                @if ($errors->has('link_order'))
                                    <p class="text-danger mt-1">{{ $errors->first('link_order') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row form-switch form-switch-md p-0" dir="ltr">
                            <label class="col-md-2 col-form-label" for="switch_rt">Status</label>
                            <div class="col-md-10 d-flex gap-2 align-items-center">
                                <label class="d-inline-block me-5 mb-0 text-secondary">Tidak Aktif</label>
                                <input class="form-check-input" class="d-inline-block" type="checkbox" id="switch_rt"
                                    name="status">
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>


                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md text-center">Tambah UMKM</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

@endsection

@section('script')

    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector: '#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endsection
