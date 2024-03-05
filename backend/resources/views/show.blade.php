@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h2 class="py-3 text-center">{{ $restaurant->name }}</h2>
            <div class="">

                <div class="imgBoxShow rounded">
                    <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }} alt="">
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
                            <button class="btn btn-primary add"
                                onclick="cartAddElement({{ $product->id }}, '{{ $product->name }}'),hideMinButton({{ $product->id }})">+</button>
                            <span class="counter" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                id="{{ $product->id }}span">
                                0
                            </span>
                            <button class="btn btn-danger remove"
                                onclick="cartRemoveElement({{ $product->id }}, '{{ $product->name }}'), hideMinButton({{ $product->id }})">-</button>
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
                //ciclo sugli elementi nel local storage
                for (let i = 0; i < localStorage.length; i++) {
                    // seleziono la key 
                    let key = localStorage.key(i);
                    // recupero il nome del prodotto 
                    name = element.getAttribute('data-name');
                    console.log(name)
                    // salvo il valore corrispondente che si trova nel local storage in una variabile 
                    let value = localStorage.getItem(key);
                    // se il nome prodotto dello span è uguale a quello nel local storage gli sparo dentro il valore corrispondente 
                    if (name == key) {
                        document.querySelector(`span[data-name="${name}"]`).innerHTML = value
                    } else {
                        console.log(`span[data-name=${name}]`);
                    }

                }

                // recupero l'id 
                id = element.getAttribute('data-id');
                // richiamo la funzione per nascondere il tasto meno, e gli passo l'id 
                hideMinButton(id)
            });

        };

        // nascondo il bottone se il valore è 0 
        function hideMinButton(id) {
            valore = document.getElementById(`${id}span`).innerHTML
            // seleziono il bottone - 
            const min = document.getElementById(`product-${id}`).getElementsByClassName("remove")[0]
            if (valore == 0) {
                min.classList.add(
                    "d-none")
            } else {
                if (min.classList.contains("d-none")) {

                    min.classList.remove("d-none")
                }
            }
        }


        //richiama la funzione al caricamento del dom
        document.addEventListener('DOMContentLoaded', function() {
            aggiornaCounter();

        });


        //funzione che aggiunge elementi alla lista dei prodotti selezionati
        function cartAddElement(product_id, product_name) {
            // recupero il valore della quantità
            let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
            //incremento la quantitù
            quantity++
            console.log(quantity);
            // salvo la coppia nome-quantità nel local storage 
            localStorage.setItem(product_name, quantity)
            // la sparo in pagina nello span relativo a quel prodotto
            document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity
            // richiamo la funzione che mi aggiorna i prodotti nel carrello 
            riempiCarrello(product_name);

        }

        //funzione che rimuove elementi alla lista dei prodotti selezionati
        function cartRemoveElement(product_id, product_name) {
            let quantity = Number(document.querySelector(`span[data-name="${product_name}"]`).innerHTML)
            // controllo che la quantità sia maggiore di 0, e in caso decremento, altrimenti setto il valore a 0 
            if (quantity > 0) {
                quantity--
            } else {
                quantity = 0
            }
            console.log(quantity);
            localStorage.setItem(product_name, quantity)
            document.querySelector(`span[data-name="${product_name}"]`).innerHTML = quantity

            riempiCarrello(product_name);
        }
    </script>
@endsection
