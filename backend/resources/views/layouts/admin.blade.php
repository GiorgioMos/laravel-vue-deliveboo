<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    {{-- SCRIPT CHARTJS --}}
    @vite(['node_modules\chartjs-plugin-zoom\dist\chartjs-plugin-zoom.min.js'])
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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

                <a class="nav-link page-navigation btnNavbar"
                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                <a class="nav-link page-navigation btnNavbar"
                    href="{{ url('http://localhost:5000/') }}">{{ __('Home') }}</a>



                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link page-navigation" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li id="nav-right" class="nav-item">
                                <a class="nav-link page-navigation"
                                    href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown text-white">
                            <a class="nav-link page-navigation btnNavbar" href="{{ route('admin.dashboard') }}"
                                role="button" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="text-white" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item drop-style"
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item drop-style" href="{{ route('logout') }}"
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
                        <a class="nav-link text-white btnNavbar" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-sign-out-alt fa-lg fa-fw me-2"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
    </div>
    </nav>


    {{-- ------------- FINE NAVBAR  ---------------- --}}

    <div id="MainContainer" class="container-fluid vh-100">
        <div class="row h-100 ">
            <div class="h-100 col-md-3 col-lg-2 ms-5 d-flex align-items-center">
                <nav id="sidebarMenu" class=" bg-dark navbar-dark sidebar w-100">
                    <ul class="nav h-100 flex-column justify-content-evenly">

                        <li class="nav-item h5">
                            <a class="nav-link text-white font {{ Route::currentRouteName() == 'admin.dashboard' ? 'Sidebarselected' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-tachometer-alt fa-lg fa-fw me-2"></i> Dashboard
                            </a>
                        </li>

                        {{-- il tuo ristorante --}}
                        {{-- utilizzo il codice magico per ottenere l'id del ristorante e importo il modello --}}
                        @php
                            use App\Models\Restaurant;
                            use App\Models\Product;
                            use App\Models\Order;

                            $currentUser = Auth::id();
                            // prendo l'id del ristorante collegato all'utente
                            $restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
                            $products = Product::all()->where('restaurant_id', $restaurant->id);
                            $orders = Order::whereHas('products', function ($query) use ($restaurant) {
                                $query->where('restaurant_id', $restaurant->id);
                            })->get();
                        @endphp
                        {{-- controllo se esiste un ristorante associato all'utente e se esiste creo il link --}}
                        @if (isset($restaurant->id))
                            <li class="nav-item h5">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.show' ? 'Sidebarselected' : '' }}"
                                    href="{{ route('admin.restaurants.show', $restaurant->id) }}">
                                    <i class="fa-solid fa-utensils me-2"></i> Il tuo ristorante
                                </a>
                            </li>
                            @if (count($products) > 0)
                                {{-- products --}}
                                <li class="nav-item h5">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.products.index' ? 'Sidebarselected' : '' }}"
                                        href="{{ route('admin.products.index') }}">
                                        <i class="fa-solid fa-bowl-food me-2"></i> Prodotti
                                    </a>
                                </li>
                            @endif

                            {{-- add products --}}
                            <li class="nav-item h5">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.products.create' ? 'Sidebarselected' : '' }}"
                                    href="{{ route('admin.products.create') }}">
                                    <i class="fa-solid fa-plus me-2"></i> Crea Prodotti
                                </a>
                            </li>
                            @if (count($orders) > 0)
                                {{-- order --}}
                                <li class="nav-item h5">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.orders.index' ? 'Sidebarselected' : '' }}"
                                        href="{{ route('admin.orders.index') }}">
                                        <i class="fa-solid fa-box-archive me-2"></i> Ordini
                                    </a>
                                </li>

                                {{-- CHART  --}}
                                <li class="nav-item h5">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.' ? 'Sidebarselected' : '' }}"
                                        href="{{ route('admin.') }}">
                                        <i class="fa-solid fa-chart-line"></i></i> Statistiche
                                    </a>
                                </li>
                            @endif
                        @else
                            {{-- add restaurants --}}
                            <li class="nav-item h5">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.create' ? 'Sidebarselected' : '' }}"
                                    href="{{ route('admin.restaurants.create') }}">
                                    <i class="fa-solid fa-utensils me-2"></i> Crea Ristorante
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <main class="col-md-9 col-lg-9 px-md-4 d-flex justify-content-center">
                @yield('content')
            </main>
        </div>
    </div>

    </div>
</body>
<style scoped>
    /* navbar style */
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

    /* /navbar style */

    .Sidebarselected {
        background: #ff9900;

        transition: .15s ease-in;
    }

    .Sidebarselected:hover {
        background: #ff9900;
    }

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

    #sidebarMenu {
        height: 70%;
        border-radius: 2rem;
        padding: 0 1rem;
        padding-top: 1rem;
    }

    #MainContainer {
        padding-top: 3rem;
    }

    .nav-link {
        border-radius: 2rem;
        padding: 1rem 2rem;
    }

    .drop-style {
        color: black !important;
    }
</style>
