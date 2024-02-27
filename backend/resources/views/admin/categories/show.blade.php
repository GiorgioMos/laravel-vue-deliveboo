@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <h2 class="py-3 text-center">{{ $category->name }}</h2>
        <div class="col-3">
            <h4>{{ $category->description}}</h4>

            <h4>{{ $category->img}}</h4>



        </div>
        <div class="py-3 text-center">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Torna alla Event list</a>
            <a href="{{ route('admin.categories.edit', $category->id ) }}" class="btn btn-warning">Modifica</a>
        </div>
    </div>
</div>
@endsection