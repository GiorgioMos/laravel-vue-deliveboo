@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <h2 class="py-3 text-center">{{ $restaurant->name }}</h2>
        <div class="col-3">
            <h4>{{ $restaurant->address}}</h4>
            <h4>{{ $restaurant->description}}</h4>

            <h4>{{ $restaurant->city}}</h4>
            <h4>{{ $restaurant->telephone}}</h4>
            <h4>{{ $restaurant->website}}</h4>



        </div>
        <div class="py-3 text-center">
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary">Torna alla Event list</a>
            <a href="{{ route('admin.restaurants.edit', $restaurant->id ) }}" class="btn btn-warning">Modifica</a>
        </div>
    </div>
</div>
@endsection