@extends('layouts.admin')

@section('content')
    <div class="container py-3">

        <div class="row">
            <h1>Edit restaurant</h1>
        </div>

        <div class="row">
            <div class="col-6">
                <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST">
                    {{-- cross scripting request forgery --}}
                    @csrf
                    @method('PUT')

                    {{-- name  --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $restaurant->name }}" required>

                        {{-- error message --}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description  --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required minlength="10" max="255">{{ old('description') ?? $restaurant->description }}</textarea>

                        {{-- error message --}}
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- city  --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">city</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            name="city" value="{{ old('city') ?? $restaurant->city }}" required>

                        {{-- error message --}}
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address  --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address') ?? $restaurant->address }}" required>

                        {{-- error message --}}
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- img  --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">img</label>
                        <input type="text" class="form-control @error('img') is-invalid @enderror" id="img"
                            name="img" value="{{ old('img') ?? $restaurant->img }}" required>

                        {{-- error message --}}
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- telephone  --}}
                    <div class="mb-3">
                        <label for="telephone" class="form-label">telephone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                            name="telephone" value="{{ old('telephone') ?? $restaurant->telephone }}" required minlength="6" maxlength="15">

                        {{-- error message --}}
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- website  --}}
                    <div class="mb-3">
                        <label for="website" class="form-label">website</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                            name="website" value="{{ old('website') ?? $restaurant->website }}" required>

                        {{-- error message --}}
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- modifica category  --}}
                    {{-- <div class="mb-3">
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
                    </div> --}}

                    @foreach ($categories as $category)
                        @if ($restaurant->category->contains($category))
                            <div class="btn-group mb-3 selected"  role="group"
                                aria-label="Basic checkbox toggle button group">
                                <input hidden checked type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                    value="{{ $category->id }}" autocomplete="off">
                                {{-- con queste 2 classi btn-primary text-white le categorie rimangono blu in edit, ma il sistema non si ricorda quali sono le categorie correnti --}}
                                <label class="btn btn-outline-primary form-label rounded"
                                    for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @else
                            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                                <input hidden type="checkbox" name="categories[]" id="category{{ $category->id }}"
                                    value="{{ $category->id }}" autocomplete="off">
                                <label class="btn btn-outline-primary form-label rounded"
                                    for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endif
                    @endforeach

                    <br>
                    <button type="submit" class="btn btn-dark">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
