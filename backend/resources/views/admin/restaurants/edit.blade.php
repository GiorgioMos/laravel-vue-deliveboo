@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Edit restaurant</h1>
        </div>

        <div class="row">
            <div class="col-6">
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

                        {{-- name  --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
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
                            <label for="description" class="form-label">description</label>
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
                            <label for="city" class="form-label">city</label>
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
                            <label for="address" class="form-label">address</label>
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
                        <div class="mb-3">
                            <label for="img" class="form-label">img</label>
                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                                name="img" value="{{ old('img') ?? $restaurant->img }}" required
                                onkeyup="validateImg()">

                            {{-- error message --}}
                            <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- telephone  --}}
                        <div class="mb-3">
                            <label for="telephone" class="form-label">telephone</label>
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
                            <label for="website" class="form-label">website</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                                name="website" value="{{ old('website') ?? $restaurant->website }}" required
                                onkeyup="validateWebsite()">

                            {{-- error message --}}
                            <span id="website-error-message" class="invalid-feedback" role="alert"></span>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- modifica category  --}}
                        {{-- <div class="mb-3">
                        <label for="categories" class="form-label">seleziona i category</label>
                        <select multiple name="categories[]" id="categories" class="form-select">
                            @foreach ($categories as $category)
                                @if ($restaurant->category->contains($category))
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> --}}

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


                        <div>
                            <button id="submitButton"
                                class="form-validation btn btn-dark{{ Route::currentRouteName() == 'admin.restaurants.show' ? 'bg-secondary' : '' }}"
                                disabled>Modifica</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi e validare gli input
        function validateInputs() {
            validateName();
            validateDescription();
            validateCity();
            validateAddress();
            validateImg();
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

        // Funzione per validare il campo immagine
        function validateImg() {
            var imgInput = document.getElementById('img');
            var imgErrorMessage = document.getElementById('img-error-message');
            var file = imgInput.files[0]; // Ottieni il file selezionato

            if (file) {
                // Se è stato selezionato un file, verifica se è un'immagine
                if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    imgInput.style.borderColor = 'green';
                    imgErrorMessage.innerHTML = ''; // Rimuovi eventuali messaggi di errore precedenti
                } else {
                    imgInput.style.borderColor = 'red';
                    imgErrorMessage.innerHTML =
                        'Il file deve essere un\'immagine (formati supportati: JPEG, PNG, GIF)';
                    imgInput.value =
                    ''; // Resetta il valore dell'input per permettere la selezione di un nuovo file
                }
            } else {
                // Se non è stato selezionato alcun file, mostra un messaggio di errore
                imgErrorMessage.innerHTML = 'Devi caricare un\'immagine';
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
        // Funzione per verificare lo stato di compilazione dei campi
        function checkFormCompletion() {
            var name = document.getElementById('name').value.trim();
            var description = document.getElementById('description').value.trim();
            var city = document.getElementById('city').value.trim();
            var address = document.getElementById('address').value.trim();
            var imgInput = document.getElementById('img');
            var telephone = document.getElementById('telephone').value.trim();
            var website = document.getElementById('website').value.trim();
            var categoriesSelected = document.querySelectorAll('input[name="categories[]"]:checked').length;

            var imgErrorMessage = document.getElementById('img-error-message');

            // Verifica se tutti i campi sono compilati e almeno una categoria è selezionata
            if (name !== '' && description !== '' && description.length >= 10 && description.length <= 255 &&
                city !== '' && address !== '' &&
                telephone !== '' && telephone.length >= 6 && telephone.length <= 15 && /^[0-9\s+]+$/.test(
                    telephone) && website !== '' &&
                categoriesSelected > 0
            ) {
                // Verifica se è stato selezionato un file per l'immagine
                if (imgInput.files.length > 0) {
                    var file = imgInput.files[0];
                    // Se è stato selezionato un file, verifica se è un'immagine
                    if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                        imgInput.style.borderColor = 'green';
                        imgErrorMessage.innerHTML = ''; // Rimuovi eventuali messaggi di errore precedenti
                        document.getElementById('submitButton').disabled =
                        false; // Abilita il pulsante di invio
                        return; // Esci dalla funzione
                    } else {
                        imgInput.style.borderColor = 'red';
                        imgErrorMessage.innerHTML =
                            'Il file deve essere un\'immagine (formati supportati: JPEG, PNG, GIF)';
                    }
                } else {
                    imgInput.style.borderColor = 'red';
                    imgErrorMessage.innerHTML = 'Devi caricare un\'immagine';
                }
            }

            // Se non tutti i campi sono compilati o una categoria non è stata selezionata, disabilita il pulsante di invio
            document.getElementById('submitButton').disabled = true;
        }

        // Aggiungi listener per verificare lo stato di compilazione dei campi quando vengono modificati
        var inputs = document.querySelectorAll(
        'input[type="text"], textarea, input[name="categories[]"], #img');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', checkFormCompletion);
            input.addEventListener('change',
            checkFormCompletion); // Aggiungi anche un listener per 'change' per i checkbox
        });

        // Chiamata alla funzione all'inizio per assicurarsi che il pulsante sia nel giusto stato iniziale
        checkFormCompletion();
    });
</script>
