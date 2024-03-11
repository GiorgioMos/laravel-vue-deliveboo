@extends('layouts.admin')

@section('content')
    @php
        use App\Models\Restaurant;
        use App\Models\Product;
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
        $restaurantData = Restaurant::where('user_id', $currentUser)->first();
        if ($restaurantData) {
            $products = Product::all()->where('restaurant_id', $restaurantData->id);
        }
    @endphp
    <div class="container-fluid mt-4">
        @if ($restaurant)
            <div class="row justify-content-center">
                <h1 class="fw-bold text-center mb-5 display-3"> Benvenuto\a, <span class="text-warning">
                        {{ Auth::user()->name }}! </span>
                </h1>
                <h2 class="fw-bold my-5">Il tuo riepilogo:</h2>

                <img class="imgSfondo" src="img/logoDeliveboo.png" alt="">
                <div class="cardContainer d-flex">
                    <div class="col-4 mx-2">
                        <div class="card">
                            <div class="card-header fw-bold fs-3"> <i class="fa-solid fa-user fs-1 mx-4 teal"></i> Il tuo
                                Account </div>
                            <div class="card-body">
                                <h5 class="fw-bold">Nome: <span class="teal fw-bold">{{ Auth::user()->name }}</h5></span>
                                <h5 class="fw-bold">Cognome: <span class="teal fw-bold"> {{ Auth::user()->surname }}</h5>
                                </span>
                                <h5 class="fw-bold">Email: <span class="teal fw-bold"> {{ Auth::user()->email }}</h5></span>
                                <h5 class="fw-bold">Indirizzo: <span class="teal fw-bold"> {{ Auth::user()->address }}</h5>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mx-2">
                        <div class="card">
                            <div class="card-header fw-bold fs-3"><i class="fa-solid fa-utensils fs-1 mx-4 teal"></i>
                                Il tuo Ristorante
                            </div>
                            <div class="card-body">
                                <h5 class=" fw-bold">Creato il: {{ $restaurantData->created_at }} </h5>
                                <hr class=" fw-bold">
                                <h5 class=" fw-bold">{{ $restaurantData->name }} </h5>
                                <h5 class=" fw-bold">{{ $restaurantData->city }} </h5>
                                <h5 class=" fw-bold">{{ $restaurantData->address }} </h5>
                                <h5 class=" fw-bold">{{ $restaurantData->telephone }} </h5>
                                <h5 class=" fw-bold">{{ $restaurantData->website }} </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mx-2">
                        <div class="card">
                            <div class="card-header fw-bold fs-3">
                                <i class="fa-solid fa-burger fs-1 mx-4 teal"></i>
                                I tuoi Prodotti
                            </div>
                            <div class="card-body">
                                @foreach ($products as $products)
                                    <h5 class=" fw-bold"><i class="fa-solid fa-clipboard-list"></i> {{ $products->name }}
                                    </h5>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- @if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
				@endif
				{{ __('You are logged in!') }} --}}

            <!-- Il ristorante è stato creato -->
        @else
        <div>
            <img class="imgSfondo" src="img/logoDeliveboo.png" alt="">
        
            <div>
                <h1 class="fw-bold text-center mb-5 display-3"> Benvenuto\a, <span class="text-warning">
                    {{ Auth::user()->name }}! </span>
                </h1>
            </div>
            <!-- Il ristorante non è stato creato -->
            <div class="d-flex justify-content-center">
                <a style="text-decoration: none" class="nav-link {{ Route::currentRouteName() == 'admin.restaurants.create' ? 'bg-secondary' : '' }}"
                    href="{{ route('admin.restaurants.create') }}">
                    <button class="btn bgOrange rounded-pill fs-2 p-3">Crea ristorante</button>
                </a>
            </div>
        </div>
        @endif
    </div>
@endsection

<style>
    .btn {
        background: #060113 !important;
        border: solid 2px #ff9900 !important;
        color: white !important;
    }

    .btn.bgOrange:hover {
        background: #ff9900 !important;
        color: #060113 !important; 
    }

    .imgSfondo {
        position: absolute;
        z-index: -1;
        width: 10px;
        top: -100;
        opacity: 0.1;
        transform: scale(0.8)
    }


    .card-body {
        height: 250px
    }

    .orange {
        color: #ff9900
    }

    .teal {
        color: #066e7c
    }
</style>
