<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_category = config('categories');

        foreach ($array_category as $category) {
            $new_category = new Category();
            $new_category->fill($category);
            $new_category->save();
        }
    }
}
