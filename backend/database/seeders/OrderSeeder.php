<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        // // multiordine random
        // for ($i = 0; $i < 50; $i++) {

        //     //recupero un array con tutti gli id ristorante
        //     $restaurants_id_array = Restaurant::pluck('id')->toArray(); //pluck al posto di select o il contrario? togliere to array?
        //     //recupero un ristorante random
        //     $restaurant_id = array_rand($restaurants_id_array);
        //     // recupero array di oggetti prodotti random 
        //     $total_price = [];
        //     $products_array = [];
        //     $products_used = [];


        //     // recupero tutti i prodotti del ristorante selezionato 
        //     $products_id_array = Product::where('restaurant_id', $restaurant_id)->pluck('id')->toArray(); // ci va il ->get()   ?
        //     ddd($products_id_array);

        //     for ($i = 0; $i < rand(1, 10); $i++) {
        //         //seleziono un prodotto random
        //         $product_id = array_rand($products_id_array);
        //         // lo pusho nei prodotti usati
        //         array_push($products_used, $product_id);

        //         //controllo se l'ho già usato
        //         if (!in_array($product_id, $products_used)) {

        //             // creo oggetto prodotto 
        //             $product_obj = [
        //                 'id' => $product_id,
        //                 'price' => Product::select('price')->where('restaurant_id', $restaurant_id)->where('id', $$product_id)->first(),
        //                 'quantity' => rand(1, 10)
        //             ];

        //             // pusho l'oggetto in un array 
        //             array_push($products_array, $product_obj);
        //             array_push($total_price, $product_obj['quantity'] * $product_obj['price']); // come cazzo si fa la moltiplicazione???
        //         }
        //     }


        //     $new_order = new Order();
        //     $new_order->date = $faker->date($format = 'Y-m-d', $max = 'now');
        //     $new_order->notes = ''; // aggiungere array di note random che si ripetono, tipo 20
        //     $new_order->guest_name = $faker->name();
        //     $new_order->guest_surname = $faker->lastname();
        //     $new_order->guest_address = $faker->address();
        //     $new_order->guest_email = $faker->email();
        //     $new_order->guest_city = $faker->city();
        //     $new_order->total_price = array_sum($total_price); //inserire somma dei prodotti

        //     $new_order->save();

        //     // aggiungo i prodotti in tabella ponte 
        //     foreach ($products_array as $product) {

        //         //come primo argomento dell'attach passo l'id del prodotto, come secondo specifico il campo quantità e passo il valore corrispondente
        //         $new_order->product()->attach($product['id'], ['quantity' => $product['quantity']]);
        //     }
        // }

        $array_orders = config('orders');

        foreach ($array_orders as $order) {
            $new_order = new Order();
            $new_order->total_price = $order["total_price"];
            $new_order->date = $order["date"];
            $new_order->notes = $order["notes"];
            $new_order->guest_name = $order["guest_name"];
            $new_order->guest_surname = $order["guest_surname"];
            $new_order->guest_telephone = $order["guest_telephone"];
            $new_order->guest_email = $order["guest_email"];
            $new_order->guest_address = $order["guest_address"];
            $new_order->guest_city = $order["guest_city"];
            $new_order->save();
            //ciclo per attaccare nella tabella ponte ogni prodotto e la quantità
            foreach ($order["products"] as $key => $value) {
                //come primo argomento dell'attach passo l'id del prodotto, come secondo specifico il campo quantità e passo il valore corrispondente
                $new_order->product()->attach($order["products"][$key]["product_id"], ['quantity' => $order["products"][$key]["quantity"]]);
            }
        }
    }
}
