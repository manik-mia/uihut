<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 200; $i++)
        {
            DB::table('category_product')->insert([
                'product_id'  => Product::all()->random()->id,
                'category_id' => Category::all()->random()->id,
            ]);
        }
    }
}
