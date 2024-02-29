@extends('layouts.admin')



@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Insert new restaurant</h1>
            @isset($errore)
                <div class="alert alert-danger">
                    <strong>{{ $errore }}</strong>
                </div>
            @endisset
        </div>

        <div class="row">
            <div class="col-6">
                <form class="needs-validation" action="{{ route('admin.restaurants.store') }}" method="POST">
                    {{-- cross scripting request forgery --}}
                    @csrf

                    {{-- name  --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required onkeyup="validateName()">

                        {{-- error message --}}
                        <span id="name-error-message" class="invalid-feedback" role="alert"></span>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description  --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">description <span style="color: red;">*</span></label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" value="{{ old('description') }}" required minlength="10" max="255" onkeyup="validateDescription()"></textarea>

                        {{-- error message --}}
                        <span id="description-error-message" class="invalid-feedback" role="alert"></span>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- city  --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">city <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required onkeyup="validateCity()">

                        {{-- error message --}}
                        <span id="city-error-message" class="invalid-feedback" role="alert"></span>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address  --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required onkeyup="validateAddress()">

                        {{-- error message --}}
                        <span id="address-error-message" class="invalid-feedback" role="alert"></span>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- img  --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">img <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img" value="{{ old('img') }}" required onkeyup="validateImg()">

                        {{-- error message --}}
                        <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- telephone  --}}
                    <div class="mb-3">
                        <label for="telephone" class="form-label">telephone <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required minlength="6" maxlength="15" onkeyup="validateTelephone()">

                        {{-- error message --}}
                        <span id="telephone-error-message" class="invalid-feedback" role="alert"></span>
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- website  --}}
                    <div class="mb-3">
                        <label for="website" class="form-label">website <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror"
                            id="website" name="website" value="{{ old('website') }}" required onkeyup="validateWebsite()">

                        {{-- error message --}}
                        <span id="website-error-message" class="invalid-feedback" role="alert"></span>
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <p>I campi con * sono obbligatori</p>

                    <p id="category-error-message" class="text-danger" >Inserisci almeno una categoria</p>
                    @isset($categories)
                        @foreach ($categories as $category)
                            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                                <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                    value="{{ $category->id }}" autocomplete="off" onclick="validateCategory({{$category->id}})">
                                <label class="btn btn-outline-primary form-label rounded" for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                        
                        @endisset

                    <br>

                    @if (isset($errore))
                        <button type="submit" class="btn btn-dark disabled">Create</button>
                    @else
                        <button type="submit" class="btn btn-dark" id="registration_submit" disabled>Create</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function validateName() {
        var name = document.getElementById('name').value;
        var nameRegex = /^[a-zA-Z ]+$/;
        var nameErrorMessage = document.getElementById('name-error-message');

        if (name === '' || nameRegex.test(name)) {
            document.getElementById('name').style.borderColor = 'green';
            nameErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('name').style.borderColor = 'red';
            nameErrorMessage.innerHTML = 'Name must contain only letters and spaces';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateDescription() {
        var description = document.getElementById('description').value;
        var descriptionErrorMessage = document.getElementById('description-error-message');

        if (description.length >= 10 && description.length <= 255) {
            document.getElementById('description').style.borderColor = 'green';
            descriptionErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('description').style.borderColor = 'red';
            descriptionErrorMessage.innerHTML = 'Description must be between 10 and 255 characters';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateCity() {
        var city = document.getElementById('city').value;
        var cityErrorMessage = document.getElementById('city-error-message');

        if (city !== '' ) {
            document.getElementById('city').style.borderColor = 'green';
            cityErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('city').style.borderColor = 'red';
            cityErrorMessage.innerHTML = 'City must contain only letters and spaces';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateAddress() {
        var address = document.getElementById('address').value;
        var addressErrorMessage = document.getElementById('address-error-message');

        if (address !== '') {
            document.getElementById('address').style.borderColor = 'green';
            addressErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('address').style.borderColor = 'red';
            addressErrorMessage.innerHTML = 'Address cannot be empty';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateImg() {
        var img = document.getElementById('img').value;
        var imgErrorMessage = document.getElementById('img-error-message');

        if (img !== '') {
            document.getElementById('img').style.borderColor = 'green';
            imgErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('img').style.borderColor = 'red';
            imgErrorMessage.innerHTML = 'Img cannot be empty';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateTelephone() {
        var telephone = document.getElementById('telephone').value;
        var telephoneRegex = /^\d{6,15}$/;
        var telephoneErrorMessage = document.getElementById('telephone-error-message');

        if (telephoneRegex.test(telephone)) {
            document.getElementById('telephone').style.borderColor = 'green';
            telephoneErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('telephone').style.borderColor = 'red';
            telephoneErrorMessage.innerHTML = 'Telephone must contain between 6 and 15 digits';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function validateWebsite() {
        var website = document.getElementById('website').value;
        var websiteErrorMessage = document.getElementById('website-error-message');

        if (website !== '') {
            document.getElementById('website').style.borderColor = 'green';
            websiteErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            document.getElementById('website').style.borderColor = 'red';
            websiteErrorMessage.innerHTML = 'Invalid website URL';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    /////////////////// funzione valdiazione categorie 


    //passo l'array da php a js
    var categories = <?php echo json_encode($categories); ?>;

    // svuoto l'array delle checkbox
    var array_categories_value = [];

    function validateCategory(valore) {

        if(array_categories_value.includes(valore)) {

           let index = array_categories_value.indexOf(valore);
           array_categories_value.splice(index, 1);
        } else {

            array_categories_value.push(valore);
        }
    
    console.log(array_categories_value);
    var categoryErrorMessage = document.getElementById('category-error-message');


        if (array_categories_value.length >= 1) {
            categoryErrorMessage.innerHTML = '';
            document.getElementById('registration_submit').disabled=false;

        } else {
            categoryErrorMessage.innerHTML = 'Inserisci almeno una categoria';
            document.getElementById('registration_submit').disabled=true;

        }
    }

    function alert() {
        alert("prova");
    }

</script>
