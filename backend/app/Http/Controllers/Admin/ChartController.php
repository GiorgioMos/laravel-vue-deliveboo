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

        // ordina date 
        // La funzione principale per ordinare le date
        function ordinaDate(array $dates): array
        {
            // Ordina l'array di date utilizzando una funzione di callback anonima
            usort($dates, function ($date1, $date2) {
                return strtotime($date1) - strtotime($date2);
            });

            // Restituisce l'array ordinato
            return $dates;
        }


        foreach ($orders as $order) {
            $value = (float)$order->total_price;
            array_push($array_prezzi, $value);
            array_push($array_date, $order->date);

            # code...
        };

        $date_ordinate = ordinaDate($array_date);

        $data = [

            'labels' => $date_ordinate,
            'data' => $array_prezzi,
        ];
        return view('admin.chart.chart', compact('data'));
    }
}
