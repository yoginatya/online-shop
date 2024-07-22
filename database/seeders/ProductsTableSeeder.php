<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();      
        $brands = Brand::all();

        foreach ($categories as $category) {
            foreach ($brands as $brand) {
                Product::create([
                    'name' => 'Product ' . $category->id . '-' . $brand->id,
                    'price' => rand(1000, 10000),
                    'category_id' => $category->id, 
                    'brand_id' => $brand->id, 
                    'stock' => rand(10, 100),
                ]);
            }
        }
    
    }
}