@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Prodotti') }}</div>
                    <div class="card-body">
                        <div id="cardBox" class="container">
                            <div class="row">
                                {{-- se l'utente non ha un ristorante associato vede un messaggio di errore --}}
                                @if (!isset($products))
                                    <div class="alert alert-danger">
                                        <strong>non hai ancora creato un ristorante</strong>
                                    </div>
                                @else
                                    @foreach ($products as $product)
                                        <div class="col-4 mb-4 rounded d-flex flex-column align-items-center card"
                                            id="card">
                                            <!--  -->
                                            <div class="imgBoxIndex rounded">
                                                <img class="cardImg rounded" src={{ $product->img }} alt="">
                                            </div>
                                            <p class="text-capitalize fw-bold text-center my-2">name: {{ $product->name }}
                                            </p>
                                            <p>description: {{ $product->description }}</p>
                                            <p>price: {{ $product->price }}</p>
                                            <p>visible: {{ $product->visible }}</p>

                                            <img src="{{ $product->img }}" alt="product-img">

                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>


                                                {{-- Btn per triggerare modal --}}
                                                <button type="button" class="btn btn-danger inline-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $product->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                                {{-- Modal per eliminare product --}}
                                                <div class="modal fade" id="exampleModal{{ $product->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina
                                                                    Ristorante</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="modal-title fs-6" id="exampleModalLabel">Vuoi
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

                                                <a href="{{ route('admin.products.show', $product->id) }}"
                                                    class="btn info-btn my-3"><i
                                                        class="fa-solid fa-circle-info fa-2xl"></i></a>
                                            </div>

                                            {{-- chiusura card  --}}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
