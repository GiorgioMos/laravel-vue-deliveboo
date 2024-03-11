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
        $new_lead = new Order();
        $new_lead->fill($validated);

        $newOrder->save();
        Mail::to('sandbox.smtp.mailtrap.io')->send(new NewContact($new_lead));

        // mi arriva nella request un array di oggetti key value con id e quantità, lo chiamo PRODUCTS
        foreach ($request->products as $product) {
            $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }
        return response()->json(['messaggio' => 'Dati salvati con successo'], 200);
    }
}
