<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        return response()->json([
            "success" => true,
            "payload" => $restaurants
        ]);
    }

    // metodo show che usa il success true/false
    public function show($id)
    {
        $restaurants = Restaurant::with("category")->find($id);

        return response()->json([
            "success" => $restaurants ? true : false,
            "payload" => $restaurants ? $restaurants : "Nessun ristorante corrispondente all'id"
        ]);
    }
}
