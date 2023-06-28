<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'variation_id',
        'quantity'
    ];


    public function Products()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id', 'id');
    }

    // public function edit(){
    //     DB::table('cart_items')
    //     ->where('id', $this->id)->where('user_id', Auth::id())
    //     ->update([
    //         'quantity' => $this->quantity,
    //     ]);
    // }

    public function delete(){
        DB::table('cart_items')
        ->where('id', $this->id)
        ->delete();
    }
}
