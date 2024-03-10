@extends('layouts.app')

@section('content')
    <div class="container position-relative">
        @php
            use App\Models\Restaurant;
            $currentUser = Auth::id();
            // prendo l'id del ristorante collegato all'utente
            $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();

        @endphp
        @if ($restaurant->id !== $product->restaurant_id)
            <div class="container">

                <div class="alert alert-danger my-5">
                    <strong>Hai cercato una pagina che non esiste :(</strong>
                </div>
                <div>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary"> torna ai tuoi prodotti</a>
                </div>
            </div>
        @else
            {{-- --------------------INIZIO PAGINA ------------- --}}
            <div class="row d-flex justify-content-center">
                <h1 class="py-3 text-center textYellow fw-bolder">{{ $product->name }}</h1>
                <div>

                    <div class="d-flex justify-content-center">

                        <div class="imgBoxShow rounded mb-5">
                            @if (str_starts_with($product->img, 'http'))
                                <img class="cardImg rounded" src={{ $product->img }} alt="">
                            @else
                                <img class="cardImg rounded" src={{ asset('storage/' . $product->img) }} alt="">
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">

                        <div class="d-flex justify-content-center col-8">

                            <div class="d-flex justify-content-center gap-5 w-100 mb-5 ">
                                <div class="d-flex flex-column justify-items-center text-center">
                                    <h4 class="textYellow fw-bold">Prezzo </h4>
                                    <p class="fs-5 fw-light">{{ $product->price }}</p>
                                </div>
                                <div class="d-flex flex-column align-item-center">
                                    <h4 class="textYellow fw-bold">Disponibilità </h4>
                                    <p class="fs-5 fw-light text-center">
                                        @if ($product->visible == 1)
                                            <i class="fa-solid fa-check fa-xl text-success"></i>
                                        @else
                                            <i class="fa-solid fa-xmark fa-xl text-danger"></i>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column col-8">
                            <h4 class="textYellow fw-bold">Descrizione </h4>
                            <p class="fs-5 fw-light">{{ $product->description }}</p>
                        </div>

                    </div>
                    <div class="py-3 text-center d-flex justify-content-center align-items-center gap-5">
                        <a id="back" href="{{ route('admin.products.index') }}"
                            class=" fw-bold btn bgTeal text-white">Torna
                            alla lista dei
                            prodotti</a>
                        <a id="edit" href="{{ route('admin.products.edit', $product->id) }}"
                            class="btn bgYellow fw-bold text-white">Modifica</a>
                    </div>
                </div>
                {{-- div quadratone bianco sfondo --}}
                <div id="backsquare" class="position-absolute start-50 translate-middle">
                </div>
            </div>
        @endif
    </div>
    <style>
        #backsquare {
            height: 40rem;
            width: 70rem;
            background-color: #242322e5;
            border-radius: 3rem;
            top: 70%;
            z-index: -100;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border-radius: 1.5rem;
        }

        #edit:hover {
            background-color: #f9b44d !important;
            transform: scale(1.2);
        }

        #back:hover {
            background-color: #066e7c !important;
            transform: scale(1.2);
        }
    </style>
@endsection
