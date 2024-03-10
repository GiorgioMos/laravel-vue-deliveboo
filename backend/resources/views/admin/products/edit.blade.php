@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1 class="text-center textYellow">Modifica il prodotto</h1>
        </div>

        <div class="row justify-content-center textYellow">
            <div class="col-10">
                @php
                    use App\Models\Restaurant;
                    $currentUser = Auth::id();
                    // prendo l'id del ristorante collegato all'utente
                    $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();

                @endphp
                @if ($restaurant->id !== $product->restaurant_id)
                    <div class="alert alert-danger">
                        <strong>Hai cercato una pagina che non esiste :( </strong>
                    </div>
                    <div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary"> Torna ai tuoi prodotti</a>
                    </div>
                @else
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data" class="needs-validation">
                        {{-- cross scripting request forgery --}}
                        @csrf
                        @method('PUT')
                        <p>Tutti i campi sono obbligatori <span class="text-danger">*</span></p>

                        {{-- name  --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') ?? $product->name }}" required
                                onkeyup="validateName()">

                            {{-- error message --}}
                            <span id="name-error-message" class="invalid-feedback" role="alert"></span>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- description  --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione <span
                                    style="color: red;">*</span></label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" required minlength="10" max="255" onkeyup="validateDescription()">{{ old('description') ?? $product->description }}</textarea>

                            {{-- error message --}}
                            <span id="description-error-message" class="invalid-feedback" role="alert"></span>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- price  --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo <span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price') ?? $product->price }}" min="0.01" max="999.99"
                                step="0.01" required onkeyup="validatePrice()">

                            {{-- error message --}}
                            <span id="price-error-message" class="invalid-feedback" role="alert"></span>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- img  --}}
                        <div class="mb-5" id="formpic">
                            <label for="img" class="form-label">Immagine <span class="text-danger">*</span></label>
                            <div class="d-flex mt-2 mb-5">

                                <div>Tieni l'immagine caricata in precedenza
                                    <div class="imgEditContainer rounded">
                                        @if (str_starts_with($product->img, 'http'))
                                            <img class="cardImg rounded" src={{ $product->img }} alt="">
                                        @else
                                            <img class="cardImg rounded" src={{ asset('storage/' . $product->img) }}
                                                alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mx-5">
                                    <p class="fs-4">oppure</p>
                                </div>
                                <div>
                                    <p>Carica una nuova immagine</p>
                                    <input type="file" class="form-control @error('img') is-invalid @enderror"
                                        id="img" name="img" value="{{ old('img') ?? $product->img }}"
                                        onchange="setPreviewPic()">

                                    {{-- error message --}}
                                    <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('img')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- visible  --}}
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <label for="visible" class="form-label">Visibile</label>
                                    <input type="hidden" name="visible" class="form-check-input" value="0">
                                    <input type="checkbox" id="visible" name="visible" value="1"
                                        class="form-check-input @error('visible') is-invalid @enderror"
                                        @if (old('visible') || $product->visible) checked @endif onchange="validateVisible()">
                                    {{-- error message --}}
                                    <span id="visible-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('visible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button id="submitButton" type="submit" class="btn bgYellow fw-bold mb-5 text-white"
                            disabled>Edit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <style>
        label {
            font-weight: 800;
        }

        input {
            border-width: 2px !important;
        }

        #submitButton:hover {
            background-color: #f9b44d !important;
            transform: scale(1.2);
        }
    </style>
@endsection

<script>
    // FUNZIONE VALIDAZIONE COME IN EDIT RESTAURANT

    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi e validare gli input
        function validateInputs() {
            validateName();
            validateDescription();
            validatePrice();
        }


        // Funzione per validare il campo nome
        function validateName() {
            var name = document.getElementById('name').value.trim();
            var nameField = document.getElementById('name');

            if (name !== '') {
                nameField.style.borderColor = 'green';
            } else {
                nameField.style.borderColor = 'red';
            }
        }

        // Funzione per validare il campo descrizione
        function validateDescription() {
            var description = document.getElementById('description').value.trim();
            var descriptionField = document.getElementById('description');

            if (description.length >= 10 && description.length <= 255) {
                descriptionField.style.borderColor = 'green';
            } else {
                descriptionField.style.borderColor = 'red';
            }
        }
        // Funzione per validare il campo telefono
        function validatePrice() {
            var price = document.getElementById('price').value.trim();
            var priceField = document.getElementById('price');

            if (price >= 0.01 && price <= 999.99) {
                priceField.style.borderColor = 'green';
            } else {
                priceField.style.borderColor = 'red';
            }
        }


        // Aggiungi listener per verificare lo stato di compilazione dei campi quando vengono modificati
        var inputs = document.querySelectorAll('input[type="text"], textarea, input[type="number"]');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', validateInputs);
        });

        // Chiama la funzione di validazione all'inizio per assicurarsi che il bordo degli input sia nel giusto stato iniziale
        validateInputs();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi
        function checkFormCompletion() {
            var name = document.getElementById('name').value.trim();
            var description = document.getElementById('description').value.trim();
            var price = document.getElementById('price').value.trim();

            var imgErrorMessage = document.getElementById('img-error-message');

            // Verifica se tutti i campi sono compilati
            if (name !== '' && description !== '' && description.length >= 10 && description.length <= 255 &&
                price !== '' && price >= 0.01 && price <= 999.99
            ) {
                // Abilita il pulsante di invio
                document.getElementById('submitButton').disabled = false;
            } else {
                // Disabilita il pulsante di invio se non tutti i campi sono compilati o una categoria non è stata selezionata
                document.getElementById('submitButton').disabled = true;
            }
        }


        // Aggiungi listener per verificare lo stato di compilazione dei campi quando vengono modificati
        var inputs = document.querySelectorAll('input[type="text"], textarea, input[type="number"]');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', checkFormCompletion);
            input.addEventListener('change',
                checkFormCompletion); // Aggiungi anche un listener per 'change' per i checkbox
        });

        // Chiamata alla funzione all'inizio per assicurarsi che il pulsante sia nel giusto stato iniziale
        checkFormCompletion();
    })
</script>
