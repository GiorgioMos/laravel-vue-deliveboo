@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-3">
            <h4 class="mt-4">ordine numero: {{$order->id}}</h4>
            <p><strong> totale:</strong>{{ $order->total_price}}</p>
            <p><strong>data ordine:</strong>{{ $order->date}}</p>
            <p><strong>note:</strong>{{ $order->notes}}</p>
            <p><strong>nome:</strong>{{ $order->guest_name}}</p>
            <p><strong>cognome:</strong>{{ $order->guest_surname}}</p>
            <p><strong>telefono:</strong>{{ $order->guest_telephone}}</p>
            <p><strong>email:</strong>{{ $order->guest_email}}</p>
            <p><strong>indirizzo:</strong>{{ $order->guest_address}}</p>
            <p><strong>città:</strong>{{ $order->guest_city}}</p>

        </div>
        <div class="py-3 text-center">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Torna alla Order list</a>
        </div>
    </div>
</div>
@endsection