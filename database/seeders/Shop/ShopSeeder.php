<?php

namespace Database\Seeders\Shop;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create();
        Product::factory(50)->create();
    }
}
