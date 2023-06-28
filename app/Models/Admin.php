<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';

    public $timestamp = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password'
    ];

    public function edit(){
        DB::table('admins')
        ->where('id', $this->id)
        ->update([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'password' => $this->password,
            'phone' => $this->phone,
        ]);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
