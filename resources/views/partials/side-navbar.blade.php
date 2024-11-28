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
                        <i class='bx bxs-graduation'></i>
                        <span key="t-class">Utama</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('rw.index') }}" key="m-rw">RW</a></li>
                        <li><a href="{{ route('rt.index') }}" key="m-rw">RT</a></li>
                        <li><a href="{{ route('staff-category.index') }}" key="m-staff-category">Jabatan</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-graduation'></i>
                        <span key="t-class">Pegawai RW</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @php
                            $rws = App\Models\MRw::all();
                        @endphp

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('staff-rw.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-graduation'></i>
                        <span key="t-class">Pegawai RT</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @php
                            $rts = App\Models\MRt::all();
                        @endphp

                        @foreach ($rts as $rt)
                            <li><a href="{{ route('staff-rt.index', ['rt' => $rt->id]) }}"
                                    key="rt-{{ $rt->id }}">{{ $rt->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-graduation'></i>
                        <span key="t-class">Fasilitas RW</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @php
                            $rws = App\Models\MRw::all();
                        @endphp

                        @foreach ($rws as $rw)
                            <li><a href="{{ route('facility.index', ['rw' => $rw->id]) }}"
                                    key="rw-{{ $rw->id }}">{{ $rw->name }}</a></li>
                        @endforeach
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bxs-graduation'></i>
                        <span key="t-class">Fasilitas RT</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">

                        @foreach ($rts as $rt)
                            <li><a href="{{ route('facility.index', ['rt' => $rt->id]) }}"
                                    key="rt-{{ $rt->id }}">{{ $rt->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
