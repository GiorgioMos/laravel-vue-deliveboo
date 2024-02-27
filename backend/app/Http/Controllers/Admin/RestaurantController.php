<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\RestaurantRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        $categories = Category::all();

        return view('admin.restaurants.index', compact("restaurants", "categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.restaurants.create', compact("categories", "categories"));
    }

    /**

     */
    public function store(RestaurantRequest $request)
    {

        //prendo i dati della colonna user_id e li trascrivo in un array
        $lista_id = Restaurant::pluck('user_id')->toArray();
        // recupero e salvo in variabile l'id dell'utente corrente
        $current_user = Auth::id();
        // controllo se l'id utente corrente è presente nell'array degli id utente dei ristoranti esistenti
        // se è presente reindirizzo su index, altrimenti creo il ristorante
        if (in_array($current_user, $lista_id)) {

            //todo fixare sto errore
            $errore = 'hai gia un ristorante';
            return view('admin.restaurants.create', compact('errore'));
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

        return view("admin.restaurants.show", compact("restaurant"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();
        $restaurant->update($validated);
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route("admin.restaurants.index");
    }
}