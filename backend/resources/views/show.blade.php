@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h2 class="py-3 text-center">{{ $restaurant->name }}</h2>
            <div class="">

                <div class="imgBoxShow rounded">
                    @if (str_starts_with($restaurant->img, 'http'))
                        <img class="cardImg rounded" src={{ $restaurant->img }} alt="">
                    @else
                        <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }} alt="">
                    @endif
                </div>

                <h4>Indirizzo: {{ $restaurant->address }}</h4>
                <h4>Descrizione: {{ $restaurant->description }}</h4>

                <h4>Città: {{ $restaurant->city }}</h4>
                <h4>Telefono: {{ $restaurant->telephone }}</h4>
                <h4>Sito Web: {{ $restaurant->website }}</h4>

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
                            <span class="counter" id="{{ $product->id }}span">0</span>
                            <button class="btn btn-danger"
                                onclick="cartRemoveElement({{ $product->id }}, '{{ $product->name }}')">-</button>
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
        function riempiCarrello() {
            const container = document.getElementById("offcanvas-body")
            document.getElementById("offcanvas-body").innerHTML = "";

            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let value = localStorage.getItem(key);



                var newElement = document.createElement("div");
                newElement.setAttribute("id", key)
                newElement.innerHTML = key + " : " + value;
                container.appendChild(newElement)
                // alert(`${key}: ${localStorage.getItem(key)}`);
            }
        }
        //controllo su ordine da singolo ristorNTE DA IMPLEMENTARE!!
        var productsQuantity = []

        document.querySelectorAll('.product').forEach(element => {
            let currentElement = {
                id: element.id,
                quantity: 0,
            }
            productsQuantity.push(currentElement);

        });

        console.log(productsQuantity);
        //funzione che aggiunge elementi alla lista dei prodotti selezionati
        function cartAddElement(product_id, product_name) {
            let index = productsQuantity.findIndex(element => element.id === `product-` + product_id)


            productsQuantity[index].quantity++;

            console.log(index)
            console.log(productsQuantity);


            localStorage.setItem(product_name, productsQuantity[index].quantity);
            document.getElementById(product_id + 'span').innerHTML = productsQuantity[index].quantity;
            riempiCarrello();

        }

        //funzione che rimuove elementi alla lista dei prodotti selezionati
        function cartRemoveElement(product_id, product_name) {
            let index = productsQuantity.findIndex(element => element.id === `product-` + product_id)


            if (productsQuantity[index].quantity > 0) {
                productsQuantity[index].quantity--;
            } else {
                productsQuantity[index].quantity = 0; //mai sotto lo zero !!
            }
            console.log(index)
            console.log(productsQuantity)

            localStorage.setItem(product_name, productsQuantity[index].quantity);
            document.getElementById(product_id + 'span').innerHTML = productsQuantity[index].quantity;
            riempiCarrello();
        }

        function clearCart() {
            localStorage.clear();
        }
    </script>
@endsection
