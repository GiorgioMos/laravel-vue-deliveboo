<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- fontawsome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- favicon --}}
<link rel="icon" type="image/svg+xml" href="/img/favicon-32x32.png" />
{{-- font --}}
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        {{-- NAVBAR  --}}
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center text-light" href="{{ url('http://localhost:5000/') }}">
                    <div>
                        <img class="logoDeliveboo" src="/img/delivebooOrange.png" alt="logoDeliveboo" />
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                {{-- <a class="nav-link page-navigation" href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a> --}}
                <a class="nav-link page-navigation btnNavbar"
                    href="{{ url('http://localhost:5000/') }}">{{ __('Home') }}</a>
                <a class="nav-link page-navigation btnNavbar"
                    href="{{ url('http://localhost:5000/about/') }}">{{ __('Chi Siamo') }}
                </a>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item ">
                            <a class="nav-link page-navigation btnNavbar"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link page-navigation btnNavbar"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown text-white">
                            <a id="navbarDropdown" class="nav-link page-navigation btnNavbar"
                                href="{{ route('admin.dashboard') }}">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="text-white" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a> --}}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li class="nav-item">
                        {{-- <a class="nav-link text-white btnNavbar" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-sign-out-alt fa-lg fa-fw me-2"></i> {{ __('Logout') }}
                        </a> --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
        </nav>
    </div>

    <main class="">
        @yield('content')
    </main>


</body>

<style>
    a {
        text-decoration: none;
    }

    footer {
        margin-top: 15rem;
        margin-bottom: 5rem;
    }

    /* // Logo deliveboo  */
    .logoDeliveboo {
        width: 9rem;
    }

    .logoDeliveboo:hover {
        transition: transform 0.4s ease;
        transform: scale(1.1);
        cursor: pointer
    }

    .logoDeliveboo:not(:hover) {
        transition: transform 0.4s ease;
        transform: scale(1);
    }

    /* icon section */
    .iconFooter {
        display: flex;
        margin-top: 60px;
    }

    .icon {
        color: white;
        font-size: 18px;
    }

    .circle {
        width: 35px;
        height: 35px;
        border: 1px solid;
        border-radius: 50%;
        margin-right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: box-shadow 0.3s;
    }

    .circle:hover {
        box-shadow: #ff9900 0px 8px 29px, #ff9900 0px 0px 21px, #ff9900 0px 4px 15px, #ff9900 0px 3px 60px, #ff9900 0px 0px 5px
    }

    .circle a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    /* // Link central column */
    .nav-item {
        text-decoration: none;
    }

    .nav-item a {
        text-decoration: none;
        font-weight: bold;
    }

    .nav-item a:hover {
        color: #ff9900;
        transform: scale(1);
    }

    .linkFooter {
        height: 100%;
    }

    /* // Image column dx */
    .boxImage {
        width: 172px;
        height: 172px;
        padding: 10px;
    }

    .boxImage:hover {
        transition: transform 0.4s ease;
        transform: scale(1.1);
        cursor: pointer
    }

    .boxImage:not(:hover) {
        transition: transform 0.4s ease;
        transform: scale(1);
    }

    .boxImage img {
        width: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    /* stile header */
    .btnNavbar {
        color: white;
        background-color: #060113;
        padding: 10px;
        border: 2px solid #ff9900;
        font-weight: bold;
        transition: .15s ease-in;
        border-radius: 30px;
        text-decoration: none;
        padding: 0.7rem 2.5rem !important;
    }

    .btnNavbar:hover {
        color: black !important;
        text-decoration: none !important;
        background-color: #ff9900;
    }
</style>

</html>
<script>
    function riempiCarrello() {
        const container = document.getElementById("offcanvas-body");
        container.innerHTML = "";
        let isEmpty = true; // Flag per verificare se il carrello è vuoto

        for (let i = 0; i < localStorage.length; i++) {
            let key = localStorage.key(i);
            let value = localStorage.getItem(key);

            // Verifica se il valore è maggiore di zero
            if (parseInt(value) > 0) {
                isEmpty = false; // Il carrello non è vuoto

                var newElement = document.createElement("div");
                newElement.setAttribute("id", key);
                newElement.innerHTML = key + " : " + value;
                container.appendChild(newElement);
            }
        }
    }
</script>
<style>
    .logoDeliveboo {
        width: 8rem;
    }

    .page-navigation {
        color: white;
        text-decoration: none;
        margin: 0 2rem;
    }

    .page-navigation:hover {
        text-decoration: underline;
        color: yellow;
    }

    font-awesome-icon {
        color: yellow;
    }

    font-awesome-icon:hover {
        color: white;
    }
</style>
