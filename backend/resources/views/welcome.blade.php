@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <div>
            <div class="row">
                <h2 class="d-flex justify-content-center">Cerca ristorante per tipologia</h2>
            </div>

            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Restaurants" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2">
                @foreach ($categories as $category)
                    <div class="btn-group mb-3 category-btn" data-category-id="{{ $category->id }}" role="group" aria-label="Basic checkbox toggle button group">
                        <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                            value="{{ $category->id }}" autocomplete="off">
                        <label class="btn btn-outline-primary form-label rounded" for="category{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
                <span id="error-msg" style="display: none">Nessun ristorante corrisponde alla ricerca</span>
            </div>


            <div class="row">
                @foreach ($restaurants as $restaurant)
                    <div class="col-4 mb-4 rounded d-flex flex-column align-items-center card category-{{ $restaurant->category_id }} hidden" id="card">
                        <div class="imgBoxIndex rounded">
                            <img class="cardImg rounded" src={{ $restaurant->img }} alt="">
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

                        {{-- chiusura card  --}}
                    </div>
                @endforeach
            </div>
        </div>


        <h1 class="display-5 fw-bold">
            Welcome to Laravel+Bootstrap 5
        </h1>

        <p class="col-md-8 fs-4">This a preset package with Bootstrap 5 views for laravel projects including laravel breeze/blade. It works from laravel 9.x to the latest release 10.x</p>
        <a href="https://github.com/lambia/LC-20230627-laravel-template" class="btn btn-primary btn-lg" type="button">Documentation</a>
    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>

@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryBtns = document.querySelectorAll('.category-btn');

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const categoryId = this.getAttribute('data-category-id');
                const categoryElements = document.querySelectorAll('.category-' + categoryId);

                categoryElements.forEach(element => {
                    element.classList.toggle('hidden');
                });
            });
        });
    });
</script>

