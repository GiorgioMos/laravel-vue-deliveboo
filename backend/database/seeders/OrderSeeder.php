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

        // ! non è costante, per funzionare bene ogni ristorante deve avere prodotti associati

        // decido il numero massimo di ordini
        for ($i = 0; $i < 10; $i++) {

            //recupero un ristorante random
            $restaurant = Restaurant::inRandomOrder()->first();

            // recupero tutti i prodotti del ristorante selezionato 
            $products_id_array = $restaurant->product()->pluck('id')->all();

            // li conto 
            $n_product = count($products_id_array);
            //controllo se esistono prodotti associati
            if ($n_product > 0) {

                //creo gli array
                $total_price = [];
                $products_array = [];
                $products_used = [];

                for ($i = 0; $i < rand(1, $n_product); $i++) {

                    //seleziono un prodotto random
                    $product_id = $restaurant->product()->inRandomOrder()->pluck('id')->first();

                    //controllo se l'ho già usato
                    if (in_array($product_id, $products_used) == false) {

                        // lo pusho nei prodotti usati
                        array_push($products_used, $product_id);

                        // creo oggetto prodotto 
                        $product_obj = [
                            'id' => $product_id,
                            'price' => Product::where('id', $product_id)->pluck('price')->first(),
                            'quantity' => rand(1, 5)
                        ];

                        // pusho l'oggetto in un array 
                        array_push($products_array, $product_obj);
                        array_push($total_price, $product_obj['quantity'] * $product_obj['price']);
                    }
                }

                $array_notes = config('order_notes');

                $new_order = new Order();
                $new_order->date = $faker->date($format = 'Y-m-d', $max = 'now');
                $new_order->notes = $array_notes[array_rand($array_notes)]; // aggiungere array di note random che si ripetono, tipo 20
                $new_order->guest_name = $faker->name();
                $new_order->guest_surname = $faker->lastname();
                $new_order->guest_address = $faker->address();
                $new_order->guest_email = $faker->email();
                $new_order->guest_city = $faker->city();
                $new_order->guest_telephone = $faker->phoneNumber();
                $new_order->total_price = array_sum($total_price);

                $new_order->save();

                // aggiungo i prodotti in tabella ponte 
                foreach ($products_array as $product) {

                    //come primo argomento dell'attach passo l'id del prodotto, come secondo specifico il campo quantità e passo il valore corrispondente
                    $new_order->product()->attach($product['id'], ['quantity' => $product['quantity']]);
                }
            }
        }

        // $array_orders = config('orders');

        // foreach ($array_orders as $order) {
        //     $new_order = new Order();
        //     $new_order->total_price = $order["total_price"];
        //     $new_order->date = $order["date"];
        //     $new_order->notes = $order["notes"];
        //     $new_order->guest_name = $order["guest_name"];
        //     $new_order->guest_surname = $order["guest_surname"];
        //     $new_order->guest_telephone = $order["guest_telephone"];
        //     $new_order->guest_email = $order["guest_email"];
        //     $new_order->guest_address = $order["guest_address"];
        //     $new_order->guest_city = $order["guest_city"];
        //     $new_order->save();
        //     //ciclo per attaccare nella tabella ponte ogni prodotto e la quantità
        //     foreach ($order["products"] as $key => $value) {
        //         //come primo argomento dell'attach passo l'id del prodotto, come secondo specifico il campo quantità e passo il valore corrispondente
        //         $new_order->product()->attach($order["products"][$key]["product_id"], ['quantity' => $order["products"][$key]["quantity"]]);
        //     }
        // }
    }
}
