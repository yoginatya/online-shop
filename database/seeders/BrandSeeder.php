<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Brand A']);
        Brand::create(['name' => 'Brand B']);
        Brand::create(['name' => 'Brand C']);
        Brand::create(['name' => 'Brand D']);
        Brand::create(['name' => 'Brand E']);
    }
}
