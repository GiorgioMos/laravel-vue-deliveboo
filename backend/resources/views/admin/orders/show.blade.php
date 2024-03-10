@extends('layouts.app')

@section('content')
    @php
        use App\Models\Restaurant;
        $currentUser = Auth::id();
        // prendo l'id del ristorante collegato all'utente
        $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();

    @endphp
    @if ($restaurant->id !== $order->products[0]->restaurant_id)
        <div class="container">

            <div class="alert alert-danger my-5">
                <strong>Hai cercato una pagina che non esiste :(</strong>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"> torna alla Dashboard</a>
            </div>
        </div>
    @else
        <div class="container">
            <div id="container" class="row d-flex justify-content-center rounded mt-5">
                <div class="col-8 row fs-5">
                    <h1 class="py-3 text-center textYellow fw-bolder">Ordine #{{ $order->id }}</h1>
                    <div class="d-flex justify-content-center gap-5 w-100 mb-5">
                        <div class="d-flex flex-column justify-items-center text-center">
                            <h4 class="spanTitle">Data ordine </h4>
                            <p class="fs-5 fw-light">{{ $order->date }}</p>
                        </div>
                        <div class="d-flex flex-column align-item-center">
                            <h4 class="spanTitle">Costo Totale </h4>
                            <p class="fs-5 fw-light text-center">{{ $order->total_price }} €</p>
                        </div>
                    </div>
                    <p><span class="spanTitle">Note ordine: </span>{{ $order->notes }}</p>
                    <h3 class="py-3 text-center textYellow fw-bolder">Dati Cliente</h3>
                    <p><span class="spanTitle">Nome: </span>{{ $order->guest_name }}</p>
                    <p><span class="spanTitle">Cognome: </span>{{ $order->guest_surname }}</p>
                    <p><span class="spanTitle">Telefono: </span>{{ $order->guest_telephone }}</p>
                    <p><span class="spanTitle">Email: </span>{{ $order->guest_email }}</p>
                    <p><span class="spanTitle">Indirizzo: </span>{{ $order->guest_address }}</p>
                    <p><span class="spanTitle">Città: </span>{{ $order->guest_city }}</p>
                    <h3 class="py-3 text-center textYellow fw-bolder">Prodotti</h3>

                    {{-- todo: recupera anche quantità prodotto --}}

                    @if (count($order->products) > 0)
                        <ul>
                            @foreach ($order->products as $product)
                                @php
                                    $quantity = $order
                                        ->products()
                                        ->where('product_id', $product->id)
                                        ->where('order_id', $order->id)
                                        ->first()->pivot->quantity;
                                @endphp
                                <li class="d-flex mb-4 align-items-center justify-content-between"><a
                                        href="{{ route('admin.products.show', $product->id) }}" class="fw-bold">
                                        <div class="imgBoxIndexOrder rounded">
                                            @if (str_starts_with($product->img, 'http'))
                                                <img class="cardImg rounded" src={{ $product->img }} alt="">
                                            @else
                                                <img class="cardImg rounded" src={{ asset('storage/' . $product->img) }}
                                                    alt="">
                                            @endif
                                        </div>
                                    </a>
                                    <span class="spanTitle">{{ $product->name }}</span>
                                    <span class="fw-bolder fs-4 textYellow">X {{ $quantity }}</span>
                                    <span>[ {{ $product->price * $quantity }}€ ]</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span>Nessun prodotto Ordinato</span>
                    @endif

                </div>
                <div class="py-3 text-center">
                    <a href="{{ route('admin.orders.index') }}" class="btn bgTeal text-white">Torna alla Lista Ordini</a>
                </div>
            </div>
        </div>
    @endif
    <style>
        #container {
            background-color: rgb(33, 37, 41);
            border-radius: 2rem;
        }

        .spanTitle {
            font-weight: 800;
            color: #066e7c;
            font-size: 1.5rem
        }

        .imgBoxIndexOrder {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            height: 5rem;
            width: 10rem;
        }

        .btn:hover {
            transform: scale(1.2);
            background-color: #066e7c
        }

        .imgBoxIndexOrder:hover {
            transform: scale(1.2);
        }
    </style>
@endsection
