<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function barChart()
    {
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();

        $orders = Order::whereHas('products', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->get();
        $array_prezzi = [];
        $array_date = [];
        foreach ($orders as $order) {
            $value = (float)$order->total_price;
            array_push($array_prezzi, $value);
            array_push($array_date, $order->date);

            # code...
        };
        // Replace this with your actual data retrieval logic
        $data = [

            'labels' => $array_date,
            'data' => $array_prezzi,
        ];
        return view('admin.chart.chart', compact('data'));
    }
}
