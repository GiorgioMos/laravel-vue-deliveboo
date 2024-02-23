<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_restaurant = config('restaurants');

        foreach ($array_restaurant as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->fill($restaurant);
            $new_restaurant->save();
        }
    }
}
