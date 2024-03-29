<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\OrderController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// restaurant index - show
Route::get("/restaurants", [RestaurantController::class, "index"]);
Route::get("restaurants/{id}", [RestaurantController::class,  "show"]);

// category show
Route::get("/categories", [CategoryController::class, "index"]);

// products show
Route::get("/products", [ProductsController::class, "index"]);

// orders post
Route::post("/orders", [OrderController::class, "store"]);
