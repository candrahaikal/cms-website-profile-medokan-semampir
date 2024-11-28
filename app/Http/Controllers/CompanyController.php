<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        // main process here ...

        return view('pages.company.index');
    }
    public function getAddCompany()
    {
        // main process here ...

        return view('pages.company.add');
    }
}
