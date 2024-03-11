<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\NewContact;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $newOrder = new Order();
        $dataMail = new Order();
        $dataMail->fill($validated);

        $newOrder->fill($validated);

        $email = $validated["guest_name"] . "." . $validated["guest_surname"] . "@gmail.com";
        $newOrder->save();
        Mail::to($email)->send(new NewContact($dataMail));

        // mi arriva nella request un array di oggetti key value con id e quantità, lo chiamo PRODUCTS
        foreach ($request->products as $product) {
            $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }
        return response()->json(['messaggio' => 'Dati salvati con successo'], 200);
    }
}
