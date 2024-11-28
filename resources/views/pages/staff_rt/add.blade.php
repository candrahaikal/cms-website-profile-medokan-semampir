@extends('layouts.main')

@section('title', 'Tambah Data Pegawai RT ' . $rt_id. ' | Medokan Semampir')

@section('content')
    <!-- begin page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Data Pegawai RT {{$rt_id}}</h4>

                <!-- begin breadcrumb -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Utama</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pegawai RT {{$rt_id}}</li>
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

                    <form class="form" action="{{ route('staff-rt.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="rt_id" value="{{ $rt_id }}">

                        <div class="mb-3 row"><label class="col-md-2 col-form-label">Jabatan</label>
                            <div class="col-md-10">
                                <select class="form-control" name="staff_category" id="staff_category">
                                    <option disabled selected>Pilih Jabatan</option>
                                    @foreach ($staffCategories as $staffCategory)
                                        <option value="{{ $staffCategory->id }}">{{ $staffCategory->name }}</option>
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
                                    placeholder="Contoh: Iqbal Ramadhan">
                                @if ($errors->has('name'))
                                    <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
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
                                <button type="submit" class="btn btn-primary w-md text-center">Tambah Pegawai RT</button>
                            </div>
                        </div>
                    </form>



                    {{-- <div class="mb-3 row"><label for="example-search-input" class="col-md-2 col-form-label">Search</label>
                        <div class="col-md-10"><input class="form-control" type="search" value="How do I shoot web"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10"><input class="form-control" type="email" value="bootstrap@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row"><label for="example-url-input" class="col-md-2 col-form-label">URL</label>
                        <div class="col-md-10"><input class="form-control" type="url" value="https://getbootstrap.com">
                        </div>
                    </div>
                    <div class="mb-3 row"><label for="example-tel-input" class="col-md-2 col-form-label">Telephone</label>
                        <div class="col-md-10"><input class="form-control" type="tel" value="1-(555)-555-5555"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-password-input"
                            class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-10"><input class="form-control" type="password" autocomplete="off"
                                value="hunter2"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-number-input" class="col-md-2 col-form-label">Number</label>
                        <div class="col-md-10"><input class="form-control" type="number" id="example-number-input"
                                value="42"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-datetime-local-input" class="col-md-2 col-form-label">Date and
                            time</label>
                        <div class="col-md-10"><input class="form-control" type="datetime-local"
                                id="example-datetime-local-input" value="2019-08-19T13:45:00"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10"><input class="form-control" type="date" id="example-date-input"
                                value="2019-08-19"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-month-input" class="col-md-2 col-form-label">Month</label>
                        <div class="col-md-10"><input class="form-control" type="month" id="example-month-input"
                                value="2019-08"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-week-input" class="col-md-2 col-form-label">Week</label>
                        <div class="col-md-10"><input class="form-control" type="week" id="example-week-input"
                                value="2019-W33"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-time-input" class="col-md-2 col-form-label">Time</label>
                        <div class="col-md-10"><input class="form-control" type="time" id="example-time-input"
                                value="13:45:00"></div>
                    </div>
                    <div class="mb-3 row"><label for="example-color-input" class="col-md-2 col-form-label">Color</label>
                        <div class="col-md-10"><input class="form-control form-control-color mw-100" type="color"
                                id="example-color-input" value="#556ee6"></div>
                    </div>
                    <div class="mb-3 row"><label class="col-md-2 col-form-label">Select</label>
                        <div class="col-md-10"><select class="form-control">
                                <option>Select</option>
                                <option>Large select</option>
                                <option>Small select</option>
                            </select></div>
                    </div>
                    <div class="row"><label class="col-md-2 col-form-label">Datalists</label>
                        <div class="col-md-10"><input class="form-control" list="datalistOptions" id="exampleDataList"
                                placeholder="Type to search..."><datalist id="datalistOptions">
                                <option value="San Francisco"></option>
                                <option value="New York"></option>
                                <option value="Seattle"></option>
                                <option value="Los Angeles"></option>
                                <option value="Chicago"></option>
                            </datalist></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

@endsection

@section('script')
    {{-- add additional script here... --}}
@endsection
