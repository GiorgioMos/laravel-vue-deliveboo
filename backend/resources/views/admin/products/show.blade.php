@extends('layouts.app')

@section('content')
    <div class="container">
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
            <div class="row d-flex justify-content-center">
                <h2 class="py-3 text-center">name: {{ $product->name }}</h2>
                <div class="col-3">
                    <div class="imgBoxShow rounded">
                        @if (str_starts_with($product->img, 'http'))
                            <img class="cardImg rounded" src={{ $product->img }} alt="">
                        @else
                            <img class="cardImg rounded" src={{ asset('storage/' . $product->img) }} alt="">
                        @endif
                    </div>
                    <h4>description:{{ $product->description }}</h4>
                    <h4>price: {{ $product->price }}</h4>


                    <h4>visible:{{ $product->visible == 1 ? 'yes' : 'no' }}</h4>



                </div>
                <div class="py-3 text-center">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna alla product list</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Modifica</a>
                </div>
            </div>
        @endif
    </div>
@endsection
