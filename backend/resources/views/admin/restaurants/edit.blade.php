@extends("layouts.admin")

@section("content")
<div class="container py-3">
    
    <div class="row">
        <h1>Edit restaurant</h1>
    </div>

    <div class="row">
        <div class="col-6">
            <form action="{{ route("admin.restaurants.update", $restaurant->id) }}" method="POST">
                {{-- cross scripting request forgery --}}
                @csrf
                @method('PUT')
                {{-- name  --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name") ?? $restaurant->name }}">

                    {{-- error message --}}
                    @error("name")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description  --}}
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" value="{{ old("description") ?? $restaurant->description }}">

                    {{-- error message --}}
                    @error("description")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- city  --}}
                <div class="mb-3">
                    <label for="city" class="form-label">city</label>
                    <input type="text" class="form-control @error("city") is-invalid @enderror" id="city" name="city" value="{{ old("city") ?? $restaurant->city }}">

                    {{-- error message --}}
                    @error("city")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- address  --}}
                <div class="mb-3">
                    <label for="address" class="form-label">address</label>
                    <input type="text" class="form-control @error("address") is-invalid @enderror" id="address" name="address" value="{{ old("address") ?? $restaurant->address }}">

                    {{-- error message --}}
                    @error("address")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- img  --}}
                <div class="mb-3">
                    <label for="img" class="form-label">img</label>
                    <input type="text" class="form-control @error("img") is-invalid @enderror" id="img" name="img" value="{{ old("img") ?? $restaurant->img }}">

                    {{-- error message --}}
                    @error("img")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- telephone  --}}
                <div class="mb-3">
                    <label for="telephone" class="form-label">telephone</label>
                    <input type="text" class="form-control @error("telephone") is-invalid @enderror" id="telephone" name="telephone" value="{{ old("telephone") ?? $restaurant->telephone }}">

                    {{-- error message --}}
                    @error("telephone")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- website  --}}
                <div class="mb-3">
                    <label for="website" class="form-label">website</label>
                    <input type="text" class="form-control @error("website") is-invalid @enderror" id="website" name="website" value="{{ old("website") ?? $restaurant->website }}">

                    {{-- error message --}}
                    @error("website")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- modifica category  --}}
                <div class="mb-3">
                    <label for="categories" class="form-label">seleziona i category</label>
                    <select multiple name="categories[]" id="categories" class="form-select">
                        @foreach ($categories as $category)
                            @if ($restaurant->category->contains($category))
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-dark">Edit</button>
                </form>
        </div>
    </div>
</div>
@endsection