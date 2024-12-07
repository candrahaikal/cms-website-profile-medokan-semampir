<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MRw;
use App\Models\MRt;
use App\Models\FacilityRt;
use App\Models\FacilityRw;
use App\Models\StaffRt;
use App\Models\StaffRw;
use App\Models\Event;


class DashboardController extends Controller
{
    public function index() {

        $totalRw = MRw::count();
        $totalRt = MRt::count();
        $totalFacilityRt = FacilityRt::count();
        $totalFacilityRw = FacilityRw::count();
        $totalStaffRt = StaffRt::count();
        $totalStaffRw = StaffRw::count();
        $totalEvents = Event::count();
        $totalKk = Mrt::sum('kk');
        $totalPopulation = Mrt::sum('population');
        $totalFacility = $totalFacilityRt + $totalFacilityRw;
        $totalStaffs = $totalStaffRt + $totalStaffRw;


        return view('pages.dashboard', [
            'totalRw' => $totalRw,
            'totalRt' => $totalRt,
            'totalFacility' => $totalFacility,
            'totalStaffs' => $totalStaffs,
            'totalEvents' => $totalEvents,
            'totalKk' => $totalKk,
            'totalPopulation' => $totalPopulation
        ]);
    }
}
