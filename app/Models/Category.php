<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'key'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function index(){
        $categories = DB::table('categories')
            ->get();
        return $categories;
    }

    public function store() {
        DB::table('categories')
        ->insert([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'key' => $this->key
        ]);
    }

    public function edit(){
        DB::table('categories')
        ->where('id', $this->id)
        ->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'key' => $this->key
        ]);
    }

    public function delete(){
        DB::table('categories')
        ->where('id', $this->id)
        ->delete();
    }
}
