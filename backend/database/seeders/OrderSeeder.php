<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
