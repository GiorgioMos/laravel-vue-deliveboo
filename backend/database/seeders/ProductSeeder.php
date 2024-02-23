<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_product = config('products');

        foreach ($array_product as $product) {
            $new_product = new Product();
            $new_product->fill($product);
            $new_product->save();
        }
    }
}
