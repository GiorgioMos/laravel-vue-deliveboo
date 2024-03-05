@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">

            <div>
                <div class="row">
                    <h2 class="d-flex justify-content-center">Cerca ristorante per tipologia</h2>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    @foreach ($categories as $category)
                        <div class="btn-group mb-3 category-btn" data-category-id="{{ $category->id }}" role="group"
                            aria-label="Basic checkbox toggle button group">
                            <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                value="{{ $category->id }}" autocomplete="off" onclick="search({{ $category->id }})">
                            <label class="btn btn-outline-primary form-label rounded" for="category{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    <span id="error-msg" style="display: none">Nessun ristorante corrisponde alla ricerca</span>
                </div>


                <div class="row">
                    @foreach ($restaurants as $restaurant)
                        {{-- passo le categorie alla card come stringa --}}

                        @php
                            // blocco di php che recupera tutti gli id categoria di un singolo ristorante e li mette in una stringa
                            $id_categories = [];
                            foreach ($restaurant->category as $category) {
                                array_push($id_categories, $category->id);
                            }
                            $id_categories = implode(',', $id_categories);
                        @endphp


                        {{-- passo la stringa con gli id categoria in un campo ad hoc chiamato meta-categories --}}
                        <div class="col-4 mb-4 rounded d-flex flex-column align-items-center card"
                            meta-categories="{{ $id_categories }}">
                            <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}" class="btn info-btn my-3">
                                <div class="imgBoxIndex rounded">
                                    @if (str_starts_with($restaurant->img, 'http'))
                                        <img class="cardImg rounded" src={{ $restaurant->img }} alt="">
                                    @else
                                        <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }}
                                            alt="">
                                    @endif

                                </div>
                                <p class="text-capitalize fw-bold text-center my-2">{{ $restaurant->name }}</p>
                                <p> {{ $restaurant->description }}</p>
                                <p> {{ $restaurant->city }}</p>
                                <p> {{ $restaurant->address }}</p>
                                <p> {{ $restaurant->telephone }}</p>
                                <p> {{ $restaurant->website }}</p>

                                {{-- category --}}
                                <h6 class="card-subtitle mb-2 text-muted pt-2">
                                    @if (count($restaurant->category) > 0)
                                        <ul>
                                            @foreach ($restaurant->category as $category)
                                                <li>{{ $category->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No Category</p>
                                    @endif
                                </h6>
                            </a>
                            {{-- chiusura card  --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">

        </div>
    </div>
@endsection


<script>
    // creo l'array vuoto con le categorie selezionate
    var categoriesSelected = [];
    // creo la variabile che deve contenere tutti i ristoranti
    var restaurants;

    // al caricamento della pagina seleziono tutti i ristoranti 
    document.addEventListener('DOMContentLoaded', function() {
        restaurants = document.querySelectorAll(".card");
    });

    // funzione search 
    function search(id_categoria) {

        // controllo se una categoria è presente nell'array delle categorie selezionate e in caso lo pusho o lo rimuovo 
        if (categoriesSelected.includes(id_categoria)) {
            var index = categoriesSelected.indexOf(id_categoria);
            categoriesSelected.splice(index, 1);
        } else {
            categoriesSelected.push(id_categoria);
        }

        restaurants.forEach(restaurant => {
            var metaCategories = restaurant.getAttribute('meta-categories').split(',');
            var showRestaurant = true; // Assumiamo inizialmente che l'elemento debba essere mostrato

            categoriesSelected.forEach(cat => {
                if (!metaCategories.includes(cat.toString())) {
                    // Se una delle categorie selezionate non è presente nell'array di categorie dell'elemento, non mostriamo l'elemento
                    showRestaurant = false;
                }
            });

            if (showRestaurant) {
                restaurant.classList.remove("d-none");
            } else {
                restaurant.classList.add("d-none");
            }
        });
    }
</script>
