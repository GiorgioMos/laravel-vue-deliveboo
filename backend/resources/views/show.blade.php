@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h2 class="py-3 text-center">{{ $restaurant->name }}</h2>
            <div class="">

                <div class="imgBoxShow rounded">
                    <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }} alt="">
                </div>

                <h4>address: {{ $restaurant->address }}</h4>
                <h4>description: {{ $restaurant->description }}</h4>

                <h4>city: {{ $restaurant->city }}</h4>
                <h4>telephone: {{ $restaurant->telephone }}</h4>
                <h4>website: {{ $restaurant->website }}</h4>

                <h4>Categorie:</h4>
                @foreach ($restaurant->category as $category)
                    <h5>{{ $category->name }}</h5>
                @endforeach

                PRODOTTI:
                <ul>

                    @foreach ($products as $product)
                        <li class="product" id="product-{{ $product->id }}">
                            <button class="btn btn-primary"
                                onclick="cartAddElement({{ $product->id }}, '{{ $product->name }}')">+</button>





                            <span class="counter" data-name="{{ $product->name }}" id="{{ $product->id }}span">
                                0
                            </span>



                            <button class="btn btn-danger"
                                onclick="cartRemoveElement({{ $product->id }}, '{{ $product->name }}' )">-</button>
                            {{ $product->name }}
                        </li>
                    @endforeach
                </ul>


            </div>
            <div class="py-3 text-center">
                <a href="/" class="btn btn-primary">Torna alla Homepage</a>
            </div>
            <div class="py-3 text-center">
                {{-- inserire rotta carrello --}}<a href="/" class="btn btn-primary" onclick="clearCart()">conferma ordine</a>
            </div>
        </div>
    </div>
    <script>
        function aggiornaCounter() {

            document.querySelectorAll('.counter').forEach(element => {
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    name = element.getAttribute('data-name');
                    console.log(name)
                    let value = localStorage.getItem(key);
                    if (name == key) {
                        document.querySelector(`span[data-name="${name}"]`).innerHTML = value
                    } else {
                        console.log(`span[data-name=${name}]`);
                    }
                }
            });

        };


        //richiama la funzione al caricamento del dom
        document.addEventListener('DOMContentLoaded', function() {
            aggiornaCounter();
        });


        //funzione che aggiunge elementi alla lista dei prodotti selezionati
        function cartAddElement(product_id, product_name) {
            let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
            quantity++
            console.log(quantity);
            localStorage.setItem(product_name, quantity)
            document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity

            riempiCarrello(product_name);

        }

        //funzione che rimuove elementi alla lista dei prodotti selezionati
        function cartRemoveElement(product_id, product_name) {
            let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
            quantity--
            console.log(quantity);
            localStorage.setItem(product_name, quantity)
            document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity

            riempiCarrello(product_name);
        }
    </script>
@endsection
