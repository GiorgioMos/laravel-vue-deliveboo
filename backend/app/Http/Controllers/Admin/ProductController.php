<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
        // strapolo il valore

        // se non esiste un utente associato al ristorante passo alla vista un messaggio di errore
        if (isset($restaurant)) {

            $restaurant_id = $restaurant->id;
            $products = Product::all()->where("restaurant_id", $restaurant_id);
            // $currentUser = Auth::id();
            // $currentRestaurant = DB::table('restaurants')->select('id')->where('user_id', $currentUser)->get()->__toString();
            // $products = DB::table('products')->whereIn('restaurant_id', $currentRestaurant)->get();

            return view('admin.products.index', compact("products"));
        } else {
            return view('admin.products.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // prendo l'id dell'utente autenticato
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
        if (isset($restaurant)) {

            $restaurant_id = $restaurant->id;
            // $currentUser = Auth::id();
            // $currentRestaurant = DB::table('restaurants')->select('id')->where('user_id', $currentUser)->get()->__toString();
            // $products = DB::table('products')->whereIn('restaurant_id', $currentRestaurant)->get();

            return view('admin.products.create', compact("restaurant_id"));
        } else {
            return view('admin.products.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        // prendo l'id dell'utente autenticato
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
        // strapolo il valore
        $restaurant_id = $restaurant->id;
        // assegno il valore al prodotto
        $validated['restaurant_id'] = $restaurant_id;

        // per importare img
        $percorsoImg = Storage::disk("public")->put('/uploads', $request['img']);
        $validated["img"] = $percorsoImg;

        $newProduct = new Product();
        $newProduct->fill($validated);
        $newProduct->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return view("admin.products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {

        $validated = $request->validated();

        // per importare img
        $percorsoImg = Storage::disk("public")->put('/uploads', $request['img']);
        $validated["img"] = $percorsoImg;

        $product->update($validated);
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("admin.products.index");
    }
}
