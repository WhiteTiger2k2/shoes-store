<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')->select( 'categories.id as category_id', 'brands.id as brand_id', 'categories.name as category', 'brands.name as brand', 'products.*')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->get();
        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('admin.product.create', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        
        if($request->hasFile('file_upload')){
            $file = $request->file_upload;
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'-'.'product.'.$ext;
            $file->move(public_path('uploads'), $file_name);
            // $product->image = $file_name;
            $request->merge(['image' => $file_name]);
        }

        // $request->merge(['image' => $file_name]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color = $request->color;
        $product->status = $request->status;
        $product->featured = $request->featured;
        $product->description =  $request->description;
        $product->active = $request->active;
        $product->store();

        return Redirect::route('product')->with('mess', 'Thêm sản phẩm mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $sizes = DB::table('sizes')->get();
        $variations = DB::table('product_variations')->select('sizes.number as size', 'product_variations.*')
        ->join('products', 'product_variations.product_id', '=', 'products.id')
        ->join('sizes', 'product_variations.size_id', '=', 'sizes.id')
        ->where('product_variations.product_id', $product->id)
        ->get();
        // $product = DB::table('products')->select('products.name as name', 'products.price as price', 'products.color as color', 'products.image as image', 'products.*')
        // ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        // ->where('products.id', $product->id)
        // ->get();
        // $products = DB::table('products')->where('id',$id)->get();
        // $product=Product::findOrFail($id);
        return view('admin.product.show', [
            'product' => $product,
            'variations' => $variations,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        if($request->hasFile('file_upload')){

            $file = $request->file_upload;
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'-'.'product.'.$ext;
            $file->move(public_path('uploads'), $file_name);
            $product->image = $file_name;
            // $request->merge(['image' => $file_name]);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->status = $request->status;
        $product->featured = $request->featured == TRUE ? '1' : '0';
        $product->description =  $request->description;
        $product->active = $request->active;
        $product->edit();
        return Redirect::route('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('product')->with('sucess', 'Xóa sản phẩm thành công!');
    }
}
