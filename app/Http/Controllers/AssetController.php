<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $assets = TransactionDetail::whereHas('transaction', function ($q) {
            $q->where('category_id', 2)
                ->where('umkm_id', Auth::user()->umkm->id);
        })
            // ->whereHas('coa', function ($q) {
            //     $q->where('category_id', 5);
            // })
            ->whereHas('product', function ($q) {
                $q->whereHas('purchase', function ($query) {
                    $query->whereHas('coa', function ($querycoa) {
                        $querycoa->where('category_id', 5);
                    });
                });
            })
            ->paginate(15);

        return view('user.asset.asset', compact('assets'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
