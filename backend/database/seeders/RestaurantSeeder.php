<?php

namespace Database\Seeders;

use App\Models\Restaurant;
// use App\Models\Category;

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
        // $categories = Category::all();

        foreach ($array_restaurant as $restaurant) {
            $new_restaurant = new Restaurant();

            //todo trovare il modo di usare il fill ed escludere category
            // $new_restaurant->fill($restaurant);
            $new_restaurant->user_id = $restaurant["user_id"];
            $new_restaurant->name = $restaurant["name"];
            $new_restaurant->description = $restaurant["description"];
            $new_restaurant->city = $restaurant["city"];
            $new_restaurant->address = $restaurant["address"];
            $new_restaurant->img = $restaurant["img"];
            $new_restaurant->telephone = $restaurant["telephone"];
            $new_restaurant->website = $restaurant["website"];

            $new_restaurant->save();
            $new_restaurant->category()->attach($restaurant["category"]);
        }
    }
}
