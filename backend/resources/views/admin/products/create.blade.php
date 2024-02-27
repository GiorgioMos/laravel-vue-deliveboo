@extends("layouts.admin")

@section("content")
<div class="container py-3">

    <div class="row">
        <h1>Insert new product</h1>
        @isset($errore)
        <div class="alert alert-danger">
            <strong>{{$errore}}</strong>
        </div>
        @endisset
    </div>

    <div class="row">
        <div class="col-6">
            @if (!isset($restaurant_id))
            <div class="alert alert-danger">
                <strong>non hai ancora creato un ristorante</strong>
            </div>
            @else
            <form action="{{ route("admin.products.store") }}" method="POST">
                {{-- cross scripting request forgery --}}
                @csrf

                {{-- name  --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name") }}" required>

                    {{-- error message --}}
                    @error("name")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description  --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span style="color: red;">*</span></label>
                    <textarea type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" value="{{ old("description") }}" required minlength="10" max="255"></textarea>

                    {{-- error message --}}
                    @error("description")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- price  --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
                    <input type="number" class="form-control @error("price") is-invalid @enderror" id="price" name="price" value="{{ old("price") }}" min="0.01" max="999.99" step="0.01" required>

                    {{-- error message --}}
                    @error("price")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- img  --}}
                <div class="mb-3">
                    <label for="img" class="form-label">img <span style="color: red;">*</span></label>
                    <input type="text" class="form-control @error("img") is-invalid @enderror" id="img" name="img" value="{{ old("img") }}" required>

                    {{-- error message --}}
                    @error("img")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- visible  --}}
                <div class="mb-3">
                    <div class="row">
                        <div class="col-1">


                            <label for="visible" class="form-label">visible</label>
                            <input type="hidden" class="form-check-input @error(" visible") is-invalid @enderror" id="visible" name="visible" value="0">
                            <input type="checkbox" class="form-check-input @error(" visible") is-invalid @enderror" id="visible" name="visible" value="1">

                            {{-- error message --}}
                            @error("visible")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Create</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection