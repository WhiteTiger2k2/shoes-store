<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['Giày Nam', 0, 'giay-nam', 'giày nam'],
            ['Giày Nữ', 0, 'giay-nu', 'giày nữ'],
        ];

        foreach($category as $category) {
            Category::create([
                'name' => $category[0],
                'parent_id' => $category[1],
                'slug' => $category[2],
                'key' => $category[3]
            ]);
        }
    }
}
