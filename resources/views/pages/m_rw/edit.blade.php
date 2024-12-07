@extends('layouts.main')

@section('title', 'Ubah Data ' .$rw->name.' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Ubah Data {{ $rw->name }}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Ubah Data RW</li>
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
                    

                    <form class="form" action="{{ route('rw.update', ['id' => $rw->id]) }}" method="POST">
                        @csrf


                        <div class="mb-3 row">
                            <label for="nama" class="col-md-2 col-form-label"><span>Nama <span class="text-danger">*</span></span></label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" type="text" name="name"
                                    placeholder="Contoh: RW 1" value="{{ old('name', $rw->name) }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                                @endif

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="Contoh: RW 1 Kelurahan Medokan Semampir merupakan...">
                                    {{ old('description', $rw->description) }}
                                </textarea>
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
                                <input class="form-check-input d-inline-block" type="checkbox" id="switch_rt" name="status"
                                       value="1" {{ $rw->status == 1 ? 'checked' : '' }}>

                                <!-- Label Aktif -->
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>


                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md text-center">Ubah RW</button>
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
