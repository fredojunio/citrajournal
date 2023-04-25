<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\CoaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)->paginate(15);
        $coaCategories = CoaCategory::all();
        return view('user.coa.coa', compact('coas', 'coaCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $coa = Coa::create([
                'code' => $request->code,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'umkm_id' => Auth::user()->umkm->id,
            ]);

            return redirect()->route('umkm.coa.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.coa.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coa $coa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coa $coa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coa $coa)
    {
        try {
            $coa->update([
                'code' => $request->code,
                'name' => $request->name,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('umkm.coa.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.coa.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coa $coa)
    {
        $coa->delete();
        return redirect()->route('umkm.coa.index');
    }
}
