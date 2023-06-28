<?php


namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryService
{
    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
    }

    public function show()
    {
        return Category::select('name', 'id')
            ->orderbyDesc('id')
            ->get();
    }

    public function getAll()
    {
        return Category::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Category::create([
                'name' => (string)$request->input('name')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $category): bool
    {
        // if ($request->input('parent_id') != $category->id) {
        //     $category->parent_id = (int)$request->input('parent_id');
        // }

        $category->name = (string)$request->input('name');
        $category->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $category = Category::where('id', $id)->first();
        if ($category) {
            return Category::where('id', $id)->delete();
        }

        return false;
    }


    public function getId($id)
    {
        return Category::where('id', $id)->firstOrFail();
    }

    public function getProduct($category, $request)
    {
        $query = $category->products()
            ->select('categories.name as category', 'product_images.path as image', 'discounts.name as discount', 'discounts.discount_percent as discount_percent', 'products.*')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('discounts', 'products.discount_id', '=', 'discounts.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}
