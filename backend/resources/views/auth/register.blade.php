@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <h1 class="card-header text-center textYellow">{{ __('Registrati') }}</h1>

                    <div class="card-body bgOrange ps-5 my-5 orangeDiv p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Nome') }} <span
                                        style="color: red;">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror py-3 rounded-pill"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        onkeyup="validateName()">
                                    <span id="name-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Cognome --}}
                            <div class="mb-4 row">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Cognome') }}
                                    <span style="color: red;">*</span></label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror py-3 rounded-pill"
                                        name="surname" value="{{ old('surname') }}" required autocomplete="surname"
                                        autofocus onkeyup="validateSurname()">
                                    <span id="surname-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-white fs-5 ext-md-right">{{ __('Indirizzo Email') }}
                                    <span style="color: red;">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror py-3 rounded-pill"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        onkeyup="validateEmail()">
                                    <span id="email-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Password --}}
                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Password') }}
                                    <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror py-3 rounded-pill"
                                        name="password" required autocomplete="new-password" onkeyup="checkPasswordMatch()">
                                    <span id="password-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Conferma Password') }}
                                    <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control py-3 rounded-pill"
                                        name="password_confirmation" required onkeyup="checkPasswordMatch()"
                                        autocomplete="new-password">
                                    <span id="password-confirm-message" class="mt-1"></span>
                                </div>
                            </div>

                            {{-- Indirizzo --}}
                            <div class="mb-4 row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Indirizzo') }}
                                    <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror py-3 rounded-pill"
                                        name="address" value="{{ old('address') }}" required autocomplete="address"
                                        autofocus onkeyup="validateAddress()">
                                    <span id="address-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- p_iva --}}
                            <div class="mb-4 row">
                                <label for="p_iva"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Partita IVA') }}
                                    <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="p_iva" type="text"
                                        class="form-control @error('p_iva') is-invalid @enderror py-3 rounded-pill"
                                        name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva"
                                        autofocus onkeyup="validatePiva()">
                                    <span id="p_iva-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('p_iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- telephone --}}
                            <div class=" row">
                                <label for="telephone"
                                    class="col-md-4 col-form-label text-white fs-5 text-md-right">{{ __('Telefono') }}
                                    <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="telephone" type="text"
                                        class="form-control @error('telephone') is-invalid @enderror py-3 rounded-pill"
                                        name="telephone" value="{{ old('telephone') }}" required
                                        autocomplete="telephone" autofocus onkeyup="validateTelephone()">
                                    <span id="telephone-error-message" class="invalid-feedback" role="alert"></span>
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="my-5 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="registration_submit" type="submit" class="btn bgOrange rounded-pill"
                                        disabled>
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .btn {
            background: #060113;
            border: solid 2px #ff9900;
            color: white;
        }

        .btn.bgOrange:hover {
            background: white;
            color: #060113;
            border: solid 2px #060113;
            transition:
        }

        label {
            color: #066e7c;
            font-size: 1.25rem;
            font-weight: bolder;
        }

        .orangeDiv {
            border-radius: 2rem;
        }
    </style>
@endsection

<script>
    function checkPasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password-confirm').value;
        var passwordMatchMessage = document.getElementById('password-confirm-message');

        if (password === confirmPassword && password !== '' && confirmPassword !== '') {
            passwordMatchMessage.innerHTML = '';
            document.getElementById('password').style.borderColor = 'green';
            document.getElementById('password-confirm').style.borderColor = 'green';
            document.getElementById('registration_submit').disabled = false;
        } else if (password !== confirmPassword && password !== '' && confirmPassword !== '') {
            passwordMatchMessage.innerHTML = 'Passwords do not match';
            passwordMatchMessage.style.color = 'red';
            document.getElementById('password').style.borderColor = 'red';
            document.getElementById('password-confirm').style.borderColor = 'red';
            document.getElementById('registration_submit').disabled = true;
        } else {
            passwordMatchMessage.innerHTML = '';
            document.getElementById('password').style.borderColor = '';
            document.getElementById('password-confirm').style.borderColor = '';
            document.getElementById('registration_submit').disabled = true;
        }
    }

    function validateName() {
        var name = document.getElementById('name').value;
        var nameRegex = /^[a-zA-Z ]+$/;
        var nameErrorMessage = document.getElementById('name-error-message');

        if (nameRegex.test(name)) {
            document.getElementById('name').style.borderColor = 'green';
            nameErrorMessage.innerHTML = '';
        } else {
            document.getElementById('name').style.borderColor = 'red';
            nameErrorMessage.innerHTML = 'Name must contain only letters and spaces';
        }
    }

    function validateSurname() {
        var surname = document.getElementById('surname').value;
        var surnameRegex = /^[a-zA-Z ]+$/;
        var surnameErrorMessage = document.getElementById('surname-error-message');

        if (surnameRegex.test(surname)) {
            document.getElementById('surname').style.borderColor = 'green';
            surnameErrorMessage.innerHTML = '';
        } else {
            document.getElementById('surname').style.borderColor = 'red';
            surnameErrorMessage.innerHTML = 'Surname must contain only letters and spaces';
        }
    }

    function validateEmail() {
        var email = document.getElementById('email').value;
        var emailRegex = /\S+@\S+\.\S+/;
        var emailErrorMessage = document.getElementById('email-error-message');

        if (emailRegex.test(email)) {
            document.getElementById('email').style.borderColor = 'green';
            emailErrorMessage.innerHTML = '';
        } else {
            document.getElementById('email').style.borderColor = 'red';
            emailErrorMessage.innerHTML = 'Invalid email address';
        }
    }

    function validateAddress() {
        var address = document.getElementById('address').value;
        var addressErrorMessage = document.getElementById('address-error-message');

        if (address.trim() !== '') {
            document.getElementById('address').style.borderColor = 'green';
            addressErrorMessage.innerHTML = '';
        } else {
            document.getElementById('address').style.borderColor = 'red';
            addressErrorMessage.innerHTML = 'Address cannot be empty';
        }
    }

    function validatePiva() {
        var piva = document.getElementById('p_iva').value;
        var pivaRegex = /^\d{11}$/;
        var pivaErrorMessage = document.getElementById('p_iva-error-message');

        if (pivaRegex.test(piva)) {
            document.getElementById('p_iva').style.borderColor = 'green';
            pivaErrorMessage.innerHTML = '';
        } else {
            document.getElementById('p_iva').style.borderColor = 'red';
            pivaErrorMessage.innerHTML = 'Partita IVA must contain exactly 11 digits';
        }
    }

    function validateTelephone() {
        var telephone = document.getElementById('telephone').value;
        var telephoneRegex = /^\d+$/;
        var telephoneErrorMessage = document.getElementById('telephone-error-message');

        if (telephoneRegex.test(telephone)) {
            document.getElementById('telephone').style.borderColor = 'green';
            telephoneErrorMessage.innerHTML = '';
        } else {
            document.getElementById('telephone').style.borderColor = 'red';
            telephoneErrorMessage.innerHTML = 'Telephone must contain only digits';
        }
    }
</script>
