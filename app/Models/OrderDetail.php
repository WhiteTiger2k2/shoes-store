<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'variation_id',
        'quantity',
        'price'
    ];

    public function products()
    {
        return $this->hasOne(ProductVariation::class, 'id', 'variation_id');
    }
}
