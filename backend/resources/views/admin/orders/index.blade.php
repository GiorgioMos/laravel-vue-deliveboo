@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <div class="accordion" id="accordionExample">

                    @foreach ($orders as $order)
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $order->id }}" aria-expanded="false"
                                    aria-controls="{{ $order->id }}">

                                    <div class="me-5 fs-5 fw-bolder">
                                        <span class="textTeal">Ordine </span> #{{ $order->id }}

                                    </div>
                                    <div class="ms-5">
                                        {{ $order->date }}
                                    </div>

                                </button>
                            </h2>
                            <div id="{{ $order->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-10">
                                            <p><span class="fw-bolder">Nome cliente : </span> {{ $order->guest_name }}</p>
                                            <p><strong>Costo Totale : </strong> {{ $order->total_price }} €</p>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="btn info-btn my-3 bgTeal fw-bold">Dettagli</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <style>
            .accordion {
                padding: 3rem;
                background-color: rgb(33, 37, 41);
                border-radius: 1rem;
            }





            .accordion-item {
                background-color: rgb(33, 37, 41) !important;
                border: none !important;

            }

            .accordion-button {
                margin-bottom: 0.5rem !important;
            }

            .accordion-item * {
                background-color: #f5f5f5 !important;
                border: none !important;
                color: black;
                font-weight: bold !important;
                font-family: "Poppins", sans-serif !important;
                border-radius: 1rem
            }

            .btn:hover {
                transform: scale(1.2);
            }

            .info-btn {
                border: 2px solid black !important;
            }
        </style>
    @endsection
