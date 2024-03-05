@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ristoranti') }}</div>
                    <div class="card-body">
                        <div id="cardBox" class="container">
                            <div class="row">
                                @foreach ($restaurants as $restaurant)
                                    <div class="col-4 mb-4 rounded d-flex flex-column align-items-center card"
                                        id="card">
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
                                                <p>Nessuna Categoria</p>
                                            @endif
                                        </h6>

                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                                                class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>

                                            {{-- Btn per triggerare modal --}}
                                            <button type="button" class="btn btn-danger inline-block"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal{{ $restaurant->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>

                                            {{-- Modal per eliminare restaurant --}}
                                            <div class="modal fade" id="exampleModal{{ $restaurant->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina
                                                                Ristorante</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="modal-title fs-6" id="exampleModalLabel">Vuoi
                                                                eliminare "{{ $restaurant->name }}" ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">No</button>
                                                            <form id="deleteForm{{ $restaurant->id }}"
                                                                action="{{ route('admin.restaurants.destroy', $restaurant->id) }}"
                                                                method="POST" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btnModel">Si</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('admin.restaurants.show', $restaurant->id) }}"
                                                class="btn info-btn my-3"><i class="fa-solid fa-circle-info fa-2xl"></i></a>
                                        </div>

                                        {{-- chiusura card  --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
