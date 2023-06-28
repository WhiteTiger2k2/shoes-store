<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'image',
        'discount',
        'category_id',
        'brand_id',
        'color',
        'featured',
        'description',
        'active'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')
            ->withDefault(['name' => '']);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id')
            ->withDefault(['name' => '']);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function index(){
        $products = DB::table('products')
        ->get();
        return $products;
    }

    public function view(){
        DB::table('products')
        ->where('id', $this->id)->get();
    }

    public function store() {
        DB::table('products')
            ->insert([
                'name' => $this->name,
                'price' => $this->price,
                'image' => $this->image,
                'discount' => $this->discount,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'color' => $this->color,
                'status' => $this->status,
                'featured' => $this->featured,
                'description' => $this->description,
                'active' => $this->active,
            ]);
    }

    public function edit(){
        DB::table('products')
            ->where('id', $this->id)
            ->update([
                'name' => $this->name,
                'price' => $this->price,
                'image' => $this->image,
                'discount' => $this->discount,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'color' => $this->color,
                'status' => $this->status,
                'featured' => $this->featured,
                'description' => $this->description,
                'active' => $this->active,
            ]);
    }

    public function delete(){
        DB::table('products')
        ->where('id', $this->id)
        ->delete();
    }
}
