<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductSale;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('umkm_id', Auth::user()->umkm->id)->paginate(15);
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

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'umkm_id' => Auth::user()->umkm->id,
            ]);

            // Purchase
            if (!empty($request->beli) && !empty($request->harga_beli)) {
                ProductPurchase::create([
                    'product_id' => $product->id,
                    'coa_id' => $request->coa_id_beli,
                    'price' => $request->harga_beli,
                    'tax' => $request->pajak_beli ?? 0,
                ]);
            }

            // Sale
            if (!empty($request->jual) && !empty($request->harga_jual)) {
                ProductSale::create([
                    'product_id' => $product->id,
                    'coa_id' => $request->coa_id_jual,
                    'price' => $request->harga_jual,
                    'tax' => $request->pajak_jual ?? 0,
                ]);
            }

            // Stock
            if (!empty($request->monitor) && !empty($request->stock)) {
                ProductStock::create([
                    'product_id' => $product->id,
                    'coa_id' => $request->coa_id_stock,
                    'stock' => 0,
                ]);
            }

            return redirect()->route('umkm.product.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.product.index');
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
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'umkm_id' => Auth::user()->umkm->id,
            ]);

            // Purchase
            if (!empty($request->beli) && !empty($request->harga_beli)) {
                if (!empty($product->purchase)) {
                    $product->purchase->update([
                        'coa_id' => $request->coa_id_beli,
                        'price' => $request->harga_beli,
                        'tax' => $request->pajak_beli ?? 0,
                    ]);
                } else {
                    ProductPurchase::create([
                        'product_id' => $product->id,
                        'coa_id' => $request->coa_id_beli,
                        'price' => $request->harga_beli,
                        'tax' => $request->pajak_beli ?? 0,
                    ]);
                }
            }

            // Sale
            if (!empty($request->jual) && !empty($request->harga_jual)) {
                if (!empty($product->sale)) {
                    $product->sale->update([
                        'coa_id' => $request->coa_id_jual,
                        'price' => $request->harga_jual,
                        'tax' => $request->pajak_jual ?? 0,
                    ]);
                } else {
                    ProductSale::create([
                        'product_id' => $product->id,
                        'coa_id' => $request->coa_id_jual,
                        'price' => $request->harga_jual,
                        'tax' => $request->pajak_jual ?? 0,
                    ]);
                }
            }

            // Stock
            if (!empty($request->monitor)) {
                if (!empty($product->stock)) {
                    $product->stock->update([
                        'coa_id' => $request->coa_id_stock,
                        'stock' => 0,
                    ]);
                } else {
                    ProductStock::create([
                        'product_id' => $product->id,
                        'coa_id' => $request->coa_id_stock,
                        'stock' => 0,
                    ]);
                }
            }

            return redirect()->route('umkm.product.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.product.index');
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
