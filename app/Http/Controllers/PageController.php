<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('umkm.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function dashboard()
    {
        return view('user.main.dashboard');
    }
}
