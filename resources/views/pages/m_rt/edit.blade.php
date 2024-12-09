@extends('layouts.main')

@section('title', 'Ubah Data RT | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Ubah Data RT</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Ubah Data RT</li>
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
                    {{-- <div class="h4 card-title">Silakan tambahkan data RT</div> --}}
                    <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each textual HTML5
                        <code>&lt;input&gt;</code> <code>type</code>.
                    </p>

                    <form class="form" action="{{ route('rt.update', ['id' => $rt->id]) }}" method="POST">
                        @csrf


                        <div class="mb-3 row">
                            <label for="nama" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" type="text" name="name"
                                    placeholder="Contoh: RT 1" value="{{ old('name', $rt->name) }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                                @endif

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kk" class="col-md-2 col-form-label">Jumlah Kepala Keluarga <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="kk" type="number" name="kk"
                                    placeholder="Contoh: 100" min="0" required value="{{ old('kk', $rt->kk) }}">
                                @if ($errors->has('kk'))
                                    <p class="text-danger mt-1">{{ $errors->first('kk') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="population" class="col-md-2 col-form-label">Jumlah Penduduk <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="population" type="number" name="population"
                                    placeholder="Contoh: 400" min="0" required value="{{ old('population', $rt->population) }}">
                                @if ($errors->has('population'))
                                    <p class="text-danger mt-1">{{ $errors->first('population') }}</p>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <textarea name="description" id="description" cols="30" rows="10"
                                    placeholder="Contoh: RT 1 Kelurahan Medokan Semampir merupakan...">{{ old('description', $rt->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <p class="text-danger mt-1">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row form-switch form-switch-md p-0" dir="ltr">
                            <label class="col-md-2 col-form-label" for="switch_rt">Status</label>
                            <div class="col-md-10 d-flex gap-2 align-items-center">
                                <!-- Label Tidak Aktif -->
                                <label class="d-inline-block me-5 mb-0 text-secondary">Tidak Aktif</label>

                                <!-- Checkbox Status -->
                                <input class="form-check-input d-inline-block" type="checkbox" id="switch_rt" name="status" {{ $rt->status == 1 ? 'checked' : '' }}>

                                <!-- Label Aktif -->
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>


                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md text-center">Ubah RT</button>
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
