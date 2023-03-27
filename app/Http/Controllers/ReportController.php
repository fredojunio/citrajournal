<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('user.report.report');
    }

    public function labarugi()
    {
        return view('user.report.labarugi');
    }

    public function neraca()
    {
        return view('user.report.neraca');
    }

    public function healthanalysis()
    {
        return view('user.report.healthanalysis');
    }
}
