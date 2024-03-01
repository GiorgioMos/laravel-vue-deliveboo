@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <h2 class="py-3 text-center">name: {{ $product->name }}</h2>
        <div class="col-3">
            <h4>description:{{ $product->description}}</h4>
            <h4>price: {{ $product->price}}</h4>

            <img src="{{$product->img}}" alt="product-img">

            <h4>visible:{{ $product->visible == 1 ? 'yes' : 'no' }}</h4>



        </div>
        <div class="py-3 text-center">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna alla product list</a>
            <a href="{{ route('admin.products.edit', $product->id ) }}" class="btn btn-warning">Modifica</a>
        </div>
    </div>
</div>
@endsection