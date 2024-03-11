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
        $newOrder->fill($validated);
        $newOrder->save();

        // mi arriva nella request un array di oggetti key value con id e quantità, lo chiamo PRODUCTS
        foreach ($request->products as $product) {
            $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        // creo un oggetto con tutti i dati che mi serviranno nella mail 
        $dataMail = new Order();
        $dataMail->fill($validated);
        $dataMail['products'] = $validated['products'];
        // costruisco l'indirizzo email 
        $email = $validated["guest_name"] . "." . $validated["guest_surname"] . "@gmail.com";
        // passo i dati alla vista e invio la mail 
        Mail::to($email)->send(new NewContact($dataMail));

        return response()->json(['messaggio' => 'Dati salvati con successo'], 200);
    }
}
