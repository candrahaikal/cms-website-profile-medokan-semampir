@extends('layouts.main')

@section('title', 'Ubah Data Kegiatan ' . $rw->name . ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Ubah Data Kegiatan {{ $rw->name }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Ubah Data Kegiatan {{ $rw->name }}
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
                    {{-- <div class="h4 card-title">Silakan tambahkan data Kegiatan</div> --}}
                    <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each textual HTML5
                        <code>&lt;input&gt;</code> <code>type</code>.
                    </p>

                    <form class="form" action="{{ route('event.update', ['id' => $event->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" name="id" value="{{ $event->id }}">

                        {{-- Field RT --}}
                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Pilih RT</label>
                            <div class="col-md-10">
                                <select class="form-control select2" name="rt" id="rt">
                                    <option disabled selected>Pilih RT...</option>
                                    @foreach ($rts as $rts)
                                        <option value="{{ $rts->id }}" {{ $rts->id == $event->rt_id ? 'selected' : '' }}>{{ $rw->name }} - {{ $rts->name }}
                                        </option>
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
                                    placeholder="Contoh: Pengajian Keluarga" value="{{ old('name', $event->name) }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="image" class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <input class="form-control" id="image" type="file" name="image">

                                <div class="row mt-3">
                                    <div class="col-lg-4 col-12">
                                        <p class="text-secondary">Gambar saat ini</p>
                                        <img src="{{ asset( $event->image) }}" alt="" class="img-fluid">
                                    </div>
                                </div>

                                @if ($errors->has('image'))
                                    <p class="text-danger mt-1">{{ $errors->first('image') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Deskripsi</label>

                            <div class="col-md-10">
                                <textarea name="description" id="description" cols="30" rows="10"
                                    placeholder="Kegiatan ini diikuti oleh...">{{ old('description', $event->description) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="date" class="col-md-2 col-form-label">Tanggal</label>
                            {{-- <div class="col-md-10">
                                <input class="form-control" id='date" type="text" name='date"
                                    placeholder="Contoh: 0858598">

                            </div> --}}
                            <div class="col-md-10">
                                <input class="form-control" type="date" id="date" name="date" value="{{ old('date', $event->date) }}">
                                @if ($errors->has('date'))
                                    <p class="text-danger mt-1">{{ $errors->first('date') }}</p>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="location" class="col-md-2 col-form-label">Lokasi</label>
                            <div class="col-md-10">
                                <input class="form-control" id="location" type="text" name="location"
                                    placeholder="https://g.co/kgs/BstkDC6" value="{{ old('location', $event->location) }}">
                                @if ($errors->has('location'))
                                    <p class="text-danger mt-1">{{ $errors->first('location') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row form-switch form-switch-md p-0" dir="ltr">
                            <label class="col-md-2 col-form-label" for="switch_rt">Status</label>
                            <div class="col-md-10 d-flex gap-2 align-items-center">
                                <label class="d-inline-block me-5 mb-0 text-secondary">Tidak Aktif</label>
                                <input class="form-check-input" class="d-inline-block" type="checkbox" id="switch_rt"
                                    name="status" {{ $event->status == 1 ? 'checked' : '' }}>
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>


                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md text-center">Ubah Kegiatan</button>
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
