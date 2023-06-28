<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = [
            ['Nike', 'giay-nike', 'giày nike'],
            ['Adidas', 'giay-adidas', 'giày adidas'],
            ['Vans', 'giay-vans', 'giày vans'],
            ['Converse', 'giay-converse', 'giày converse']
        ];

        foreach($brand as $brand) {
            Brand::create([
                'name' => $brand[0],
                'slug' => $brand[1],
                'key' => $brand[2]
            ]);
        }
    }
}
