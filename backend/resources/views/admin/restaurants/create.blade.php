@extends("layouts.admin")

@section("content")
<div class="container py-3">

    <div class="row">
        <h1>Insert new restaurant</h1>
        @isset($errore)
        <div class="alert alert-danger">
            <strong>{{$errore}}</strong>
        </div>
        @endisset
    </div>

    <div class="row">
        <div class="col-6">
            <form action="{{ route("admin.restaurants.store") }}" method="POST">
                {{-- cross scripting request forgery --}}
                @csrf

                {{-- name  --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error(" name") is-invalid @enderror" id="name" name="name" value="{{ old("name") }}">

                    {{-- error message --}}
                    @error("name")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description  --}}
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control @error(" description") is-invalid @enderror" id="description" name="description" value="{{ old("description") }}">

                    {{-- error message --}}
                    @error("description")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- city  --}}
                <div class="mb-3">
                    <label for="city" class="form-label">city</label>
                    <input type="text" class="form-control @error(" city") is-invalid @enderror" id="city" name="city" value="{{ old("city") }}">

                    {{-- error message --}}
                    @error("city")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- address  --}}
                <div class="mb-3">
                    <label for="address" class="form-label">address</label>
                    <input type="text" class="form-control @error(" address") is-invalid @enderror" id="address" name="address" value="{{ old("address") }}">

                    {{-- error message --}}
                    @error("address")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- img  --}}
                <div class="mb-3">
                    <label for="img" class="form-label">img</label>
                    <input type="text" class="form-control @error(" img") is-invalid @enderror" id="img" name="img" value="{{ old("img") }}">

                    {{-- error message --}}
                    @error("img")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- telephone  --}}
                <div class="mb-3">
                    <label for="telephone" class="form-label">telephone</label>
                    <input type="text" class="form-control @error(" telephone") is-invalid @enderror" id="telephone" name="telephone" value="{{ old("telephone") }}">

                    {{-- error message --}}
                    @error("telephone")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- website  --}}
                <div class="mb-3">
                    <label for="website" class="form-label">website</label>
                    <input type="text" class="form-control @error(" website") is-invalid @enderror" id="website" name="website" value="{{ old("website") }}">

                    {{-- error message --}}
                    @error("website")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- select category --}}
                <div class="mb-3">
                    <label for="categories" class="form-label">seleziona le categorie</label>
                    <select multiple name="categories[]" id="categories" class="form-select">
                        <option selected value="">seleziona almeno un category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                @if(isset($errore))
                <button type="submit" class="btn btn-dark disabled">Create</button>
                @else
                <button type="submit" class="btn btn-dark">Create</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection