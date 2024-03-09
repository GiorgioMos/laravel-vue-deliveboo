@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="row">
            <h1 class="text-center textYellow">Modifica il tuo ristorante</h1>
        </div>

        <div class="row justify-content-center textYellow">
            <div class="col-10">
                @php
                    use App\Models\Restaurant;
                    $currentUser = Auth::id();
                    // prendo l'id del ristorante collegato all'utente
                    $current_restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();

                @endphp
                @if ($current_restaurant->id !== $restaurant->id)
                    <div class="alert alert-danger">
                        <strong>Hai cercato una pagina che non esiste :( </strong>
                    </div>
                    <div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary"> torna ai tuoi prodotti</a>
                    </div>
                @else
                    <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{-- cross scripting request forgery --}}
                        @csrf
                        @method('PUT')
                        <p>Tutti i campi sono obbligatori <span class="text-danger">*</span></p>

                        {{-- name  --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') ?? $restaurant->name }}" required
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
                                    class="text-danger">*</span></label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" required minlength="10" max="255" onkeyup="validateDescription()">{{ old('description') ?? $restaurant->description }}</textarea>

                            {{-- error message --}}
                            <span id="description-error-message" class="invalid-feedback" role="alert"></span>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- city  --}}
                        <div class="mb-3">
                            <label for="city" class="form-label">Città <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                name="city" value="{{ old('city') ?? $restaurant->city }}" required
                                onkeyup="validateCity()">

                            {{-- error message --}}
                            <span id="city-error-message" class="invalid-feedback" role="alert"></span>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- address  --}}
                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') ?? $restaurant->address }}" required
                                onkeyup="validateAddress()">

                            {{-- error message --}}
                            <span id="address-error-message" class="invalid-feedback" role="alert"></span>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- img  --}}
                        <div class="mb-5" id="formpic">
                            <label for="img" class="form-label">Immagine <span class="text-danger">*</span></label>
                            <div class="d-flex mt-2 mb-5">

                                <div>Tieni l'immagine caricata in precedenza
                                    <div class="imgEditContainer rounded">
                                        @if (str_starts_with($restaurant->img, 'http'))
                                            <img class="cardImg rounded" src={{ $restaurant->img }} alt="">
                                        @else
                                            <img class="cardImg rounded" src={{ asset('storage/' . $restaurant->img) }}
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
                                        id="img" name="img" value="{{ old('img') ?? $restaurant->img }}"
                                        onchange="setPreviewPic()">

                                    {{-- error message --}}
                                    <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('img')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- telephone  --}}
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telefono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                id="telephone" name="telephone" value="{{ old('telephone') ?? $restaurant->telephone }}"
                                required minlength="6" maxlength="15" onkeyup="validateTelephone()">

                            {{-- error message --}}
                            <span id="telephone-error-message" class="invalid-feedback" role="alert"></span>
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- website  --}}
                        <div class="mb-3">
                            <label for="website" class="form-label">Sito web <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror"
                                id="website" name="website" value="{{ old('website') ?? $restaurant->website }}"
                                required onkeyup="validateWebsite()">

                            {{-- error message --}}
                            <span id="website-error-message" class="invalid-feedback" role="alert"></span>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="categories[]" class="form-label d-block">Categorie <span
                                class="text-danger">*</span></label>

                        @foreach ($categories as $category)
                            @if ($restaurant->category->contains($category))
                                <div class="btn-group mb-3 selected" role="group"
                                    aria-label="Basic checkbox toggle button group">
                                    <input hidden checked type="checkbox" name="categories[]"
                                        id="category{{ $category->id }}" value="{{ $category->id }}"
                                        autocomplete="off">
                                    {{-- con queste 2 classi btn-primary text-white le categorie rimangono blu in edit, ma il sistema non si ricorda quali sono le categorie correnti --}}
                                    <label class="btn btn-outline-primary form-label rounded"
                                        for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @else
                                <div class="btn-group mb-3" role="group"
                                    aria-label="Basic checkbox toggle button group">
                                    <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                        value="{{ $category->id }}" autocomplete="off">
                                    <label class="btn btn-outline-primary form-label rounded"
                                        for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach


                        <div class="d-flex justify-content-center">
                            <button id="submitButton"
                                class="form-validation btn bgYellow fw-bold mb-5 text-white{{ Route::currentRouteName() == 'admin.restaurants.show' ? 'bg-secondary' : '' }}"
                                disabled>Modifica</button>
                        </div>
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

        .form-validation:hover {
            background-color: #f9b44d !important;
            transform: scale(1.2);
        }
    </style>
@endsection

<script>
    //funzione prova per mostrare la pic quando l'utente fa l'upload, magari si facesse davvero così
    // todo fai sta funzione come bonus
    function setPreviewPic() {
        value = document.getElementById('img').files[0]
        console.log(value)
    };
    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi e validare gli input
        function validateInputs() {
            validateName();
            validateDescription();
            validateCity();
            validateAddress();
            validateTelephone();
            validateWebsite();
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

        // Funzione per validare il campo città
        function validateCity() {
            var city = document.getElementById('city').value.trim();
            var cityField = document.getElementById('city');

            if (city !== '') {
                cityField.style.borderColor = 'green';
            } else {
                cityField.style.borderColor = 'red';
            }
        }

        // Funzione per validare il campo indirizzo
        function validateAddress() {
            var address = document.getElementById('address').value.trim();
            var addressField = document.getElementById('address');

            if (address !== '') {
                addressField.style.borderColor = 'green';
            } else {
                addressField.style.borderColor = 'red';
            }
        }

        // Funzione per validare il campo telefono
        function validateTelephone() {
            var telephone = document.getElementById('telephone').value.trim();
            var telephoneRegex = /^[\d\s+]+$/; // Accetta solo numeri, spazi e il carattere '+'
            var telephoneField = document.getElementById('telephone');

            if (telephoneRegex.test(telephone) && telephone.length >= 6 && telephone.length <= 15) {
                telephoneField.style.borderColor = 'green';
            } else {
                telephoneField.style.borderColor = 'red';
            }
        }

        // Funzione per validare il campo sito web
        function validateWebsite() {
            var website = document.getElementById('website').value.trim();
            var websiteField = document.getElementById('website');

            if (website !== '') {
                websiteField.style.borderColor = 'green';
            } else {
                websiteField.style.borderColor = 'red';
            }
        }

        // Aggiungi listener per verificare lo stato di compilazione dei campi quando vengono modificati
        var inputs = document.querySelectorAll('input[type="text"], textarea');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', validateInputs);
        });

        // Chiama la funzione di validazione all'inizio per assicurarsi che il bordo degli input sia nel giusto stato iniziale
        validateInputs();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi tranne il campo immagine
        function checkFormCompletion() {
            var name = document.getElementById('name').value.trim();
            var description = document.getElementById('description').value.trim();
            var city = document.getElementById('city').value.trim();
            var address = document.getElementById('address').value.trim();
            var telephone = document.getElementById('telephone').value.trim();
            var website = document.getElementById('website').value.trim();
            var categoriesSelected = document.querySelectorAll('input[name="categories[]"]:checked').length;

            // Verifica se tutti i campi tranne il campo immagine sono compilati e almeno una categoria è selezionata
            if (name !== '' && description !== '' && description.length >= 10 && description.length <= 255 &&
                city !== '' && address !== '' &&
                telephone !== '' && telephone.length >= 6 && telephone.length <= 15 && /^[0-9\s+]+$/.test(
                    telephone) && website !== '' &&
                categoriesSelected > 0
            ) {
                // Abilita il pulsante di invio
                document.getElementById('submitButton').disabled = false;
            } else {
                // Disabilita il pulsante di invio se non tutti i campi sono compilati o una categoria non è stata selezionata
                document.getElementById('submitButton').disabled = true;
            }
        }

        // Aggiungi listener per verificare lo stato di compilazione dei campi quando vengono modificati
        var inputs = document.querySelectorAll(
            'input[type="text"], textarea, input[name="categories[]"]');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', checkFormCompletion);
            input.addEventListener('change',
                checkFormCompletion); // Aggiungi anche un listener per 'change' per i checkbox
        });

        // Chiamata alla funzione all'inizio per assicurarsi che il pulsante sia nel giusto stato iniziale
        checkFormCompletion();
    });
</script>
