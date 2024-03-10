@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1 class="text-center textYellow">Inserisci un nuovo prodotto</h1>
            @isset($errore)
                <div class="alert alert-danger">
                    <strong>{{ $errore }}</strong>
                </div>
            @endisset
        </div>

        <div class="row justify-content-center textYellow">
            <div class="col-10">
                @if (!isset($restaurant_id))
                    <div class="alert alert-danger">
                        <strong>non hai ancora creato un ristorante</strong>
                    </div>
                @else
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                        class="needs-validation">
                        {{-- cross scripting request forgery --}}
                        @csrf
                        <p>Tutti i campi sono obbligatori <span class="text-danger">*</span></p>

                        {{-- name  --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required onkeyup="validateName()">

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
                                name="description" value="{{ old('description') }}" required minlength="10" max="255"
                                onkeyup="validateDescription()"></textarea>

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
                                name="price" value="{{ old('price') }}" min="0.01" max="999.99" step="0.01"
                                required onkeyup="validatePrice()">

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
                                name="img" value="{{ old('img') }}" required onchange="validateImg()">

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
                                    <input type="hidden" class="form-check-input @error(' visible') is-invalid @enderror"
                                        id="visible-hidden" name="visible" value="0">
                                    <input type="checkbox" class="form-check-input @error(' visible') is-invalid @enderror"
                                        id="visible" name="visible" value="1" onchange="validateVisible()">

                                    {{-- error message --}}
                                    <span id="visible-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('visible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark bgTeal fw-bold mb-5 text-white"
                                id="registration_submit" disabled>Crea</button>
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

        #registration_submit:hover {
            background-color: #066e7c !important;
            transform: scale(1.2);
        }
    </style>
@endsection

<script>
    // Variabile per memorizzare i valori delle categorie selezionate
    var array_categories_value = [];

    // Funzione di validazione del nome
    function validateName() {
        var name = document.getElementById('name').value;
        var nameRegex = /^[a-zA-Z ]+$/;
        var nameErrorMessage = document.getElementById('name-error-message');

        if (name === '' || !nameRegex.test(name)) {
            document.getElementById('name').style.borderColor = 'red';
            nameErrorMessage.innerHTML = 'Name must contain only letters and spaces';
        } else {
            document.getElementById('name').style.borderColor = 'green';
            nameErrorMessage.innerHTML = '';
        }
        checkFormValidity();
    }

    // Funzione di validazione della descrizione
    function validateDescription() {
        var description = document.getElementById('description').value;
        var descriptionErrorMessage = document.getElementById('description-error-message');

        if (description.length >= 10 && description.length <= 255) {
            document.getElementById('description').style.borderColor = 'green';
            descriptionErrorMessage.innerHTML = '';
        } else {
            document.getElementById('description').style.borderColor = 'red';
            descriptionErrorMessage.innerHTML = 'Description is required';
        }
        checkFormValidity();
    }

    function validatePrice() {
        var price = document.getElementById('price').value;
        var priceErrorMessage = document.getElementById('price-error-message');

        if (price >= 0.01 && price <= 999.99) {
            document.getElementById('price').style.borderColor = 'green';
            priceErrorMessage.innerHTML = '';
        } else {
            document.getElementById('price').style.borderColor = 'red';
            priceErrorMessage.innerHTML = 'Price must be between 0.01 and 999.99';
        }
        checkFormValidity();

    }

    // Funzione di validazione dell'immagine
    function validateImg() {
        var img = document.getElementById('img').value;
        var imgErrorMessage = document.getElementById('img-error-message');

        if (img !== '') {
            document.getElementById('img').style.borderColor = 'green';
            imgErrorMessage.innerHTML = '';
        } else {
            document.getElementById('img').style.borderColor = 'red';
            imgErrorMessage.innerHTML = 'Image is required';
        }
        checkFormValidity();
    }

    function checkFormValidity() {
        var name = document.getElementById('name').value;
        var description = document.getElementById('description').value;
        var img = document.getElementById('img').value;
        var price = document.getElementById('price').value;
        var visible = document.getElementById('visible').value;



        var formIsValid = name !== '' &&
            description !== '' &&
            description.length >= 10 && description.length <= 255 &&
            img !== '' &&
            price !== '' && price >= 0.01 && price <= 999.99

        document.getElementById('registration_submit').disabled = !formIsValid;
    }
</script>
