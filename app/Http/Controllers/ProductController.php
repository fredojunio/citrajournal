<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('umkm_id', Auth::user()->umkm->id)->get();
        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)->get();

        return view('user.product.product', compact('products', 'coas'));
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
            Contact::create([
                'name' => $request->name,
                'coa_id' => $request->coa_id,
                'harga_beli' => $request->harga_beli,
                'pajak_beli' => $request->pajak_beli,
                'harga_jual' => $request->harga_jual,
                'pajak_jual' => $request->pajak_jual,
                'umkm_id' => Auth::user()->umkm->id,
            ]);

            return redirect()->route('umkm.contact.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.contact.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $contact->update([
                'name' => $request->name,
                'coa_id' => $request->coa_id,
                'harga_beli' => $request->harga_beli,
                'pajak_beli' => $request->pajak_beli,
                'harga_jual' => $request->harga_jual,
                'pajak_jual' => $request->pajak_jual,
            ]);

            return redirect()->route('umkm.contact.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.contact.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('umkm.product.index');
    }
}
