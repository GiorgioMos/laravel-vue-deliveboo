@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h1 class="py-3 text-center">{{ $restaurant->name }}</h1>
            <div>
                <div class="d-flex justify-content-center">

                    <div class="imgBoxShow rounded mb-5">
                        @if (str_starts_with($restaurant->img, 'http'))
                            <img class="cardImg rounded" src={{ $restaurant->img }} alt="">
                        @else
                            <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }} alt="">
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center position-relative">

                    <div class="d-flex justify-content-center col-8">

                        <div class="d-flex justify-content-between w-100 mb-5 ">
                            <div class="d-flex flex-column justify-items-center text-center">
                                <h4 class="textYellow fw-bold">Indirizzo </h4>
                                <p class="fs-5 fw-light">{{ $restaurant->address }}</p>
                            </div>
                            <div class="d-flex flex-column align-item-center">
                                <h4 class="textYellow fw-bold">Città </h4>
                                <p class="fs-5 fw-light">{{ $restaurant->city }}</p>
                            </div>
                            <div class="d-flex flex-column justify-items-center text-center">
                                <h4 class="textYellow fw-bold">Telefono </h4>
                                <p class="fs-5 fw-light">{{ $restaurant->telephone }}</p>
                            </div>
                            <div class="d-flex flex-column justify-items-center text-center">
                                <h4 class="textYellow fw-bold">Sito Web </h4>
                                <p class="fs-5 fw-light">{{ $restaurant->website }}</p>
                            </div>
                        </div>

                        {{-- div quadratone bianco sfondo --}}
                        <div id="backsquare" class="position-absolute start-50 translate-middle">
                        </div>
                    </div>
                    <div class="d-flex flex-column col-8">
                        <h4 class="textYellow fw-bold">Descrizione </h4>
                        <p class="fs-5 fw-light">{{ $restaurant->description }}</p>
                    </div>
                    <div class="col-8">
                        <h4 class="textYellow fw-bold">Categorie</h4>
                        @foreach ($restaurant->category as $category)
                            <div class="badge customBadge bgTeal">{{ $category->name }}</div>
                        @endforeach
                    </div>
                </div>




            </div>
            <div class="py-3 text-center">
                <div class="py-3 text-center">
                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                        class="btn bgYellow fw-bold mb-5 text-white">Modifica</a>
                </div>
            </div>

        </div>
    </div>


    <style>
        #backsquare {
            height: 200%;
            width: 70rem;
            background-color: #242322e5;
            border-radius: 3rem;
            top: 50%;
            z-index: -100;
        }

        .customBadge {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border-radius: 1.5rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border-radius: 1.5rem;
            transition: .15s ease-in;
        }

        .btn:hover {
            background-color: #f9b44d !important;
            transform: scale(1.1);
        }
    </style>
@endsection
