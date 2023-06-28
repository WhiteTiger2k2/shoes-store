<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'key'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function index(){
        $brands = DB::table('brands')
            ->get();
        return $brands;
    }

    public function store() {
        DB::table('brands')
        ->insert([
            'name' => $this->name,
            'slug' => $this->slug,
            'key' => $this->key,
        ]);
    }

    public function edit(){
        DB::table('brands')
        ->where('id', $this->id)
        ->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'key' => $this->key
        ]);
    }

    public function delete(){
        DB::table('brands')
        ->where('id', $this->id)
        ->delete();
    }
}
