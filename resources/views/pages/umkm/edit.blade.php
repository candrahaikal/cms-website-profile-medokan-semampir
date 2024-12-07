@extends('layouts.main')

@section('title', 'Edit Data UMKM ' . $umkm->name . ' | Medokan Semampir')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Data UMKM {{ $umkm->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Edit Data UMKM {{ $umkm->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Edit data UMKM {{ $umkm->name }}.</p>

                    <form class="form" action="{{ route('umkm.update', ['id' => $umkm->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $umkm->id }}">

                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Pilih RT</label>
                            <div class="col-md-10">
                                <select class="form-control select2" name="rt" id="rt">
                                    <option disabled selected>Pilih RT...</option>
                                    @foreach ($rts as $rt)
                                        <option value="{{ $rt->id }}" {{ $rt->id == $umkm->rt_id ? 'selected' : '' }}>
                                            {{ $rw->name }} - {{ $rt->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rt')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" type="text" name="name" value="{{ $umkm->name }}">
                                @error('name')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="image" class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <input class="form-control" id="image" type="file" name="image">
                                @if ($umkm->image)
                                <p class="text-secondary mt-2">*Gambar saat ini</p>
                                    <img src="{{ asset($umkm->image) }}" alt="{{ $umkm->name }}"  class="img-fluid w-50">
                                @endif
                                @error('image')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $umkm->description }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="contact" class="col-md-2 col-form-label">Contact</label>
                            <div class="col-md-10">
                                <input class="form-control" id="contact" type="text" name="contact" value="{{ $umkm->contact }}">
                                @error('contact')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="link_maps" class="col-md-2 col-form-label">Link Google Maps</label>
                            <div class="col-md-10">
                                <input class="form-control" id="link_maps" type="text" name="link_maps"
                                    value="{{ $umkm->link_maps }}">
                                @error('link_maps')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="link_order" class="col-md-2 col-form-label">Link Order</label>
                            <div class="col-md-10">
                                <input class="form-control" id="link_order" type="text" name="link_order"
                                    value="{{ $umkm->link_order }}">
                                @error('link_order')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row form-switch form-switch-md p-0" dir="ltr">
                            <label class="col-md-2 col-form-label" for="switch_rt">Status</label>
                            <div class="col-md-10 d-flex gap-2 align-items-center">
                                <label class="d-inline-block me-5 mb-0 text-secondary">Tidak Aktif</label>
                                <input class="form-check-input" type="checkbox" id="switch_rt" name="status"
                                    {{ $umkm->status ? 'checked' : '' }}>
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>

                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endsection
