@extends("layouts.admin")

@section("content")
<div class="container py-3">
    
    <div class="row">
        <h1>Edit Product</h1>
    </div>

    <div class="row">
        <div class="col-6">
            <form action="{{ route("admin.products.update", $product->id) }}" method="POST">
                {{-- cross scripting request forgery --}}
                @csrf
                @method('PUT')
                {{-- name  --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name") ?? $product->name }}" required>

                    {{-- error message --}}
                    @error("name")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description  --}}
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <textarea type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" required minlength="10" max="255">{{ old("description") ?? $product->description }}</textarea>

                    {{-- error message --}}
                    @error("description")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- price  --}}
                <div class="mb-3">
                    <label for="price" class="form-label">price</label>
                    <input type="number" class="form-control @error("price") is-invalid @enderror" id="price" name="price" value="{{ old("price") ?? $product->price }}" min="0.01" max="999.99" step="0.01" required>

                    {{-- error message --}}
                    @error("price")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- img  --}}
                <div class="mb-3">
                    <label for="img" class="form-label">img</label>
                    <input type="text" class="form-control @error("img") is-invalid @enderror" id="img" name="img" value="{{ old("img") ?? $product->img }}" required>

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
                            <input type="hidden" name="visible" class="form-check-input" value="0">
                            <input type="checkbox" id="visible" name="visible" value="1" class="form-check-input @error('visible') is-invalid @enderror" @if(old('visible') || $product->visible) checked @endif>
                            {{-- error message --}}
                            @error('visible')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Edit</button>
                </form>
        </div>
    </div>
</div>
@endsection