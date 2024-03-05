@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ordini') }}</div>
                    <div class="card-body">
                        <div id="cardBox" class="container">
                            <div class="row">

                                @foreach ($orders as $order)
                                    <div class="col-4 mb-4 rounded d-flex flex-column align-items-center card"
                                        id="card">
                                        <h4 class="mt-4"><strong>codice ordine:</strong> {{ $order->id }}</h4>

                                        <p><strong>Prezzo Totale : </strong> {{ $order->total_price }} €</p>
                                        <p><strong>Data : </strong> {{ $order->date }}</p>
                                        <p><strong>Nome : </strong> {{ $order->guest_name }}</p>

                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn info-btn my-3"><i
                                                class="fa-solid fa-circle-info fa-2xl"></i></a>

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
