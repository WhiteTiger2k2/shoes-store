<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $variations = DB::table('product_variations')->select('products.name as name', 'products.price as price', 'products.color as color', 'product_variations.*')
        // ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        // ->get();
        // return view('admin.product.show', [
        //     'variations' => $variations,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = DB::table('sizes')->get();
        return view('admin.product.add_variation', [
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $variation = new ProductVariation();
        // $variation->number = $request->number;
        // $variation->size_id = $request->size_id;
        // $variation->quantity = $request->quantity;
        // $variation->store();
        $this->validate($request,[
            'quantity'=>'required|numeric'
        ]);

        ProductVariation::create($request->all());

        return back()->with('sucess', 'Thêm thành công!');
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
    public function edit(ProductVariation $variation)
    {
        $sizes = DB::table('sizes')->get();
        return view('admin.product.edit_variation', [
            'variation' => $variation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariation $variation)
    {
        $variation->quantity = $request->quantity;
        $variation->edit();
        return Redirect::route('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariation $variation)
    {
        $variation->delete();
        return back()->with('sucess', 'Xóa kích thước thành công!');
    }
}
