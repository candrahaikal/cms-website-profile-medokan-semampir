@extends('layouts.main')

@section('title', 'Ubah Data Pegawai RT ' . $rt_id. ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Ubah Data Pegawai RT {{$rt_id}}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Ubah Data Pegawai RT {{$rt_id}}</li>
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
                    {{-- <div class="h4 card-title">Silakan tambahkan data Pegawai RT</div> --}}
                    <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each textual HTML5
                        <code>&lt;input&gt;</code> <code>type</code>.
                    </p>

                    <form class="form" action="{{ route('staff-rt.update', ['id' => $staffRt->id]) }}" method="POST">
                        @csrf

                        {{-- Field RT --}}
                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Pilih RT</label>
                            <div class="col-md-10">
                                <select class="form-control select2" name="rt" id="rt">
                                    <option disabled selected>Pilih RT...</option>
                                    @foreach ($rts as $rt)
                                        <option value="{{ $rt->id }}" {{ $rt->id == $staffRt->rt_id ? 'selected' : '' }}>{{ $rw->name }} - {{ $rt->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('rt'))
                                    <p class="text-danger mt-1">{{ $errors->first('rt') }}</p>
                                @endif

                            </div>
                        </div>
                        {{-- END Field RT --}}

                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Jabatan</label>
                            <div class="col-md-10">
                                <select class="form-control" name="staff_category" id="staff_category">
                                    <option disabled selected>Pilih Jabatan</option>
                                    @foreach ($staffCategories as $staffCategory)
                                        <option value="{{ $staffCategory->id }}" {{ $staffCategory->id == $staffRt->staffCategory->id ? 'selected' : ''}}>{{ $staffCategory->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('staff_category'))
                                    <p class="text-danger mt-1">{{ $errors->first('staff_category') }}</p>
                                @endif

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" id="name" type="text" name="name"
                                    placeholder="Contoh: Iqbal Ramadhan" value="{{ old('name', $staffRt->name) }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row form-switch form-switch-md p-0" dir="ltr">
                            <label class="col-md-2 col-form-label" for="switch_staff_rt">Status</label>
                            <div class="col-md-10 d-flex gap-2 align-items-center">
                                <label class="d-inline-block me-5 mb-0 text-secondary">Tidak Aktif</label>
                                <input class="form-check-input" class="d-inline-block" type="checkbox" id="switch_staff_rt"
                                    name="status" {{ $staffRt->status == 1 ? 'checked' : '' }}>
                                <label class="d-inline-block mb-0 text-secondary">Aktif</label>
                            </div>
                        </div>

                        <div class="mb-3 row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md text-center">Ubah Pegawai RT</button>
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
    {{-- add additional script here... --}}
@endsection
