@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <div id="cardBox" class="container">
                    <div class="row">
                        {{-- se l'utente non ha un ristorante associato vede un messaggio di errore --}}
                        @if (!isset($products))
                            <div class="alert alert-danger">
                                <strong>non hai ancora creato un ristorante</strong>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="d-flex align-items-center mb-4 flex-row row card" id="card">
                                    <!--  -->
                                    <div class="col-4 p-3">

                                        <div class="imgBoxIndex rounded">
                                            @if (str_starts_with($product->img, 'http'))
                                                <img class="cardImg rounded" src={{ $product->img }} alt="">
                                            @else
                                                <img class="cardImg rounded" src={{ asset('storage/' . $product->img) }}
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <p class="text-capitalize fw-bold text-center my-2 textTeal fs-3">
                                            {{ $product->name }} </p>
                                        <div class="d-flex flex-column align-item-center">
                                            <h5 class="textTeal fw-bold">Descrizione </h5>
                                            <p class=" fw-light">{{ $product->description }}</p>
                                        </div>
                                        <div class="d-flex flex-column align-item-center">
                                            <h5 class="textTeal fw-bold">Prezzo </h5>
                                            <p class=" fw-light">{{ $product->price }} €</p>
                                        </div>
                                        <h5 class="textTeal fw-bold d-inline-block">Visibilità: </h5>

                                        <span>
                                            @if ($product->visible == 1)
                                                <i class="fa-solid fa-check fa-xl text-success"></i>
                                            @else
                                                <i class="fa-solid fa-xmark fa-xl text-danger"></i>
                                            @endif
                                        </span>




                                        {{-- chiusura card  --}}
                                    </div>

                                    {{-- contenitori bottoni in colonna  --}}
                                    <div class="col-2 d-flex flex-column gap-3 justify-content-center align-items-center">

                                        {{-- EDIT  --}}
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>


                                        {{-- Btn per triggerare modal --}}
                                        <button type="button" class="btn btn-danger inline-block" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $product->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                        {{-- Modal per eliminare product --}}
                                        <div class="modal fade" id="exampleModal{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Elimina
                                                            Ristorante</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="modal-title fs-6" id="exampleModalLabel">
                                                            Vuoi
                                                            eliminare "{{ $product->name }}" ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No</button>
                                                        <form id="deleteForm{{ $product->id }}"
                                                            action="{{ route('admin.products.destroy', $product->id) }}"
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

                                        {{-- INFO  --}}
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn info-btn"><i
                                                class="fa-solid fa-circle-info fa-2xl textTeal"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <style>
            .card {
                border-radius: 2rem;
            }

            .btn {
                transition: .15s ease-in;
            }

            .btn:hover {
                transform: scale(1.1)
            }
        </style>
    @endsection
