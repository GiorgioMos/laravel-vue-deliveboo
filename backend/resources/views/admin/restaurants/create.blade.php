@extends('layouts.admin')

<style>
    @import "{{ asset('resources/scss/prova.css') }}";
</style>

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Insert new restaurant</h1>
            @isset($errore)
                <div class="alert alert-danger">
                    <strong>{{ $errore }}</strong>
                </div>
            @endisset
        </div>

        <div class="row">
            <div class="col-6">
                <form class="needs-validation" action="{{ route('admin.restaurants.store') }}" method="POST">
                    {{-- cross scripting request forgery --}}
                    @csrf

                    {{-- name  --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>

                        {{-- error message --}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description  --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">description <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" value="{{ old('description') }}" required minlength="10" max="255">

                        {{-- error message --}}
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- city  --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">city <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>

                        {{-- error message --}}
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address  --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>

                        {{-- error message --}}
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- img  --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">img <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img" value="{{ old('img') }}" required>

                        {{-- error message --}}
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- telephone  --}}
                    <div class="mb-3">
                        <label for="telephone" class="form-label">telephone <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required minlength="6" maxlength="15">

                        {{-- error message --}}
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- website  --}}
                    <div class="mb-3">
                        <label for="website" class="form-label">website <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror"
                            id="website" name="website" value="{{ old('website') }}" required>

                        {{-- error message --}}
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <p>I campi con * sono obbligatori</p>

                    @isset($categories)
                        @foreach ($categories as $category)
                            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                                <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                    value="{{ $category->id }}" autocomplete="off">
                                <label class="btn btn-outline-primary form-label rounded" for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    @endisset

                    <br>

                    @if (isset($errore))
                        <button type="submit" class="btn btn-dark disabled">Create</button>
                    @else
                        <button type="submit" class="btn btn-dark">Create</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
