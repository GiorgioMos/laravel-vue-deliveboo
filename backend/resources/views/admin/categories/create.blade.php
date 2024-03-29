@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Insert new Category</h1>
            @isset($errore)
                <div class="alert alert-danger">
                    <strong>{{ $errore }}</strong>
                </div>
            @endisset
        </div>

        <div class="row">
            <div class="col-6">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    {{-- cross scripting request forgery --}}
                    @csrf

                    {{-- name  --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">

                        {{-- error message --}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description  --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" value="{{ old('description') }}">
                    </textarea>

                        {{-- error message --}}
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- img  --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">Immagine</label>
                        <input type="text" class="form-control @error('img') is-invalid @enderror" id="img"
                            name="img" value="{{ old('img') }}">

                        {{-- error message --}}
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
