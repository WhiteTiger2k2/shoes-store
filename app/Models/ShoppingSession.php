<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory;
    protected $table = 'shopping_sessions';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'total'
    ];
}
