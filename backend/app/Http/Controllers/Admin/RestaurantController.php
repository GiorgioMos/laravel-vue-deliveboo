<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact("restaurants"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.restaurants.create');
    }

    /**

     */
    public function store(StoreRestaurantRequest $request)
    {
        $errore = '';
        //prendo i dati della colonna user_id e li trascrivo in un array
        $lista_id = Restaurant::pluck('user_id')->toArray();
        // recupero e salvo in variabile l'id dell'utente corrente
        $current_user = Auth::id();
        // controllo se l'id utente corrente è presente nell'array degli id utente dei ristoranti esistenti
        // se è presente reindirizzo su index, altrimenti creo il ristorante
        if (in_array($current_user, $lista_id)) {

            //todo fixare sto errore
            return response()->json('Hai già creato un ristorante', 403);
        }

        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $newRestaurant = new Restaurant();

        $newRestaurant->fill($validated);


        $newRestaurant->save();
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
