<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Nguyễn Chung Thực',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'address' => 'Hà Nội',
            'phone' => '0969310735'
        ]);
    }
}
