<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->surname = $faker->lastName();
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("password"); // password: password
            $newUser->address = $faker->address();
            $newUser->p_iva = $faker->regexify('[0-9]{11}');
            $newUser->telephone = $faker->phoneNumber();
            $newUser->save();
        }
    }
}
