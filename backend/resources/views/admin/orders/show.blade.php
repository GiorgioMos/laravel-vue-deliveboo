@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-3">
                <h4 class="mt-4">codice ordine: {{ $order->id }}</h4>
                <p><strong> Totale : </strong>{{ $order->total_price }} €</p>
                <p><strong>Data ordine : </strong>{{ $order->date }}</p>
                <p><strong>Note : </strong>{{ $order->notes }}</p>
                <p><strong>Nome : </strong>{{ $order->guest_name }}</p>
                <p><strong>Cognome : </strong>{{ $order->guest_surname }}</p>
                <p><strong>Telefono : </strong>{{ $order->guest_telephone }}</p>
                <p><strong>E-mail : </strong>{{ $order->guest_email }}</p>
                <p><strong>Indirizzo : </strong>{{ $order->guest_address }}</p>
                <p><strong>Città : </strong>{{ $order->guest_city }}</p>
                <p class="mt-2"><strong>Prodotti :</strong></p>
                {{-- todo: recupera anche quantità prodotto --}}

                @if (count($order->products) > 0)
                    <ul>
                        @foreach ($order->products as $product)
                            @php
                                $quantity = $order
                                    ->products()
                                    ->where('product_id', $product->id)
                                    ->where('order_id', $order->id)
                                    ->first()->pivot->quantity;
                            @endphp
                            <li><a href="{{ route('admin.products.show', $product->id) }}"
                                    class="fw-bold">{{ $product->name }}</a> in {{ $quantity }} quantità</li>
                        @endforeach
                    </ul>
                @else
                    <span>Nessun prodotto Ordinato</span>
                @endif

            </div>
            <div class="py-3 text-center">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Torna alla Lista Ordini</a>
            </div>
        </div>
    </div>
@endsection
