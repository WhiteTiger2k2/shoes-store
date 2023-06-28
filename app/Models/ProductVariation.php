<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVariation extends Model
{
    use HasFactory;
    protected $table = 'product_variations';

    public $timestamps = true;

    protected $fillable = [
        'size_id',
        'product_id',
        'quantity'
    ];

    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id')
            ->withDefault(['number' => '']);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function store() {
        DB::table('product_variations')->where('product_id', $this->id)
            ->insert([
                'size_id' => $this->size_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
            ]);
    }

    public function edit(){
        DB::table('product_variations')
            ->where('id', $this->id)
            ->update([
                'size_id' => $this->size_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
            ]);
    }
}
