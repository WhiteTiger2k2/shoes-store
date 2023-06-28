<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';

    public $timestamps = true;

    protected $fillable = [
        'number'
    ];

    public function index(){
        $sizes = DB::table('sizes')
            ->get();
        return $sizes;
    }

    public function store() {
        DB::table('sizes')
        ->insert([
            'name' => $this->name,
        ]);
    }

    public function edit(){
        DB::table('sizes')
        ->where('id', $this->id)
        ->update([
            'name' => $this->name,
        ]);
    }

    public function delete(){
        DB::table('sizes')
        ->where('id', $this->id)
        ->delete();
    }
}
