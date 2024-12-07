<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Dasbor</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-component'></i>
                        <span key="t-class">Utama</span>
                    </a>



                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('rw.index') }}" key="m-rw">RW</a></li>
                        {{-- <li><a href="{{ route('rt.index') }}" key="m-rw">RT</a></li> --}}
                        <li><a href="{{ route('staff-category.index') }}" key="m-staff-category">Jabatan</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-user-rectangle'></i>
                        <span key="t-class">Pegawai RW</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @php
                            $rws = App\Models\MRw::orderBy('name', 'asc')->get();
                        @endphp

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('staff-rw.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                @php
                    $rts = App\Models\MRt::all();
                @endphp
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-user-account'></i>
                        <span key="t-class">Pegawai RT</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('staff-rt.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-building'></i>
                        <span key="t-class">Fasilitas RW</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('facility-rw.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-buildings'></i>
                        <span key="t-class">Fasilitas RT</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('facility-rt.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-cart-alt' ></i>
                        <span key="t-class">UMKM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('umkm.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-calendar-check'></i>
                        <span key="t-class">Kegiatan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('event.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
