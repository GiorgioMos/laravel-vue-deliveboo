@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Edit Product</h1>
        </div>

        <div class="row">
            <div class="col-6">
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
                        <div class="mb-3">
                            <label for="img" class="form-label">Immagine <span style="color: red;">*</span></label>
                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                                name="img" value="{{ old('img') ?? $product->img }}" required onchange="validateImg()">

                            {{-- error message --}}
                            <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                        <p>I campi con * sono obbligatori</p>

                        <button id="submitButton" type="submit" class="btn btn-dark" disabled>Edit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    // FUNZIONE VALIDAZIONE COME IN EDIT RESTAURANT

    document.addEventListener('DOMContentLoaded', function() {
        // Funzione per verificare lo stato di compilazione dei campi e validare gli input
        function validateInputs() {
            validateName();
            validateDescription();
            validateImg();
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
            var imgInput = document.getElementById('img');
            var price = document.getElementById('price').value.trim();

            var imgErrorMessage = document.getElementById('img-error-message');

            // Verifica se tutti i campi sono compilati
            if (name !== '' && description !== '' && description.length >= 10 && description.length <= 255 &&
                price !== '' && price >= 0.01 && price <= 999.99
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
        var inputs = document.querySelectorAll('input[type="text"], textarea, input[type="number"], #img');
        inputs.forEach(function(input) {
            input.addEventListener('keyup', checkFormCompletion);
            input.addEventListener('change',
                checkFormCompletion); // Aggiungi anche un listener per 'change' per i checkbox
        });

        // Chiamata alla funzione all'inizio per assicurarsi che il pulsante sia nel giusto stato iniziale
        checkFormCompletion();
    })
</script>
