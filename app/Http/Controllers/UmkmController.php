<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User_Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkms = Umkm::where('user_id', Auth::user()->id)->get();
        if (!empty($umkms[0])) {
            return view('user.umkm.umkm', compact('umkms'));
        }

        return view('user.umkm.create_umkm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.umkm.create_umkm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Umkm::class],
        ]);

        Umkm::create($request->all());

        return redirect()->route('umkm.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        //
    }

    public function save_umkm(Request $request)
    {
        $manage_umkm = User_Umkm::where('user_id', Auth::user()->id)->get();
        if (!empty($manage_umkm[0])) {
            $manage_umkm[0]->update([
                'umkm_id' => $request->umkm_id
            ]);
        } else {
            User_Umkm::create([
                'user_id' => Auth::user()->id,
                'umkm_id' => $request->umkm_id
            ]);
        }

        return redirect()->route('umkm.dashboard');
    }
}
