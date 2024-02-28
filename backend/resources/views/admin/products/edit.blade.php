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
                    <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name") ?? $product->name }}" required onkeyup="validateName()">

                    {{-- error message --}}
                    <span id="name-error-message" class="invalid-feedback" role="alert"></span>
                    @error("name")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description  --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span style="color: red;">*</span></label>
                    <textarea type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" required minlength="10" max="255" onkeyup="validateDescription()">{{ old("description") ?? $product->description }}</textarea>

                    {{-- error message --}}
                    <span id="description-error-message" class="invalid-feedback" role="alert"></span>
                    @error("description")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- price  --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
                    <input type="number" class="form-control @error("price") is-invalid @enderror" id="price" name="price" value="{{ old("price") ?? $product->price }}" min="0.01" max="999.99" step="0.01" required onkeyup="validatePrice()">

                    {{-- error message --}}
                    <span id="price-error-message" class="invalid-feedback" role="alert"></span>
                    @error("price")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- img  --}}
                <div class="mb-3">
                    <label for="img" class="form-label">Img <span style="color: red;">*</span></label>
                    <input type="text" class="form-control @error("img") is-invalid @enderror" id="img" name="img" value="{{ old("img") ?? $product->img }}" required onkeyup="validateImg()">

                    {{-- error message --}}
                    <span id="img-error-message" class="invalid-feedback" role="alert"></span>
                    @error("img")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- visible  --}}
                <div class="mb-3">
                    <div class="row">
                        <div class="col-1">
                            <label for="visible" class="form-label">Visible</label>
                            <input type="hidden" name="visible" class="form-check-input" value="0">
                            <input type="checkbox" id="visible" name="visible" value="1" class="form-check-input @error('visible') is-invalid @enderror" @if(old('visible') || $product->visible) checked @endif onchange="validateVisible()">
                            {{-- error message --}}
                            <span id="visible-error-message" class="invalid-feedback" role="alert"></span>
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

<script>
    function validateName() {
        var name = document.getElementById('name').value;
        var nameErrorMessage = document.getElementById('name-error-message');

        if (name !== '') {
            document.getElementById('name').style.borderColor = 'green';
            nameErrorMessage.innerHTML = '';
        } else {
            document.getElementById('name').style.borderColor = 'red';
            nameErrorMessage.innerHTML = 'Name must contain only letters and spaces';
        }
    }

    function validateDescription() {
        var description = document.getElementById('description').value;
        var descriptionErrorMessage = document.getElementById('description-error-message');

        if (description.length >= 10 && description.length <= 255) {
            document.getElementById('description').style.borderColor = 'green';
            descriptionErrorMessage.innerHTML = '';
        } else {
            document.getElementById('description').style.borderColor = 'red';
            descriptionErrorMessage.innerHTML = 'Description must be between 10 and 255 characters';
        }
    }

    function validatePrice() {
        var price = document.getElementById('price').value;
        var priceErrorMessage = document.getElementById('price-error-message');

        if (price >= 0.01 && price <= 999.99) {
            document.getElementById('price').style.borderColor = 'green';
            priceErrorMessage.innerHTML = '';
        } else {
            document.getElementById('price').style.borderColor = 'red';
            priceErrorMessage.innerHTML = 'Price must be between 0.01 and 999.99';
        }
    }

    function validateImg() {
        var img = document.getElementById('img').value;
        var imgErrorMessage = document.getElementById('img-error-message');

        if (img !== '') {
            document.getElementById('img').style.borderColor = 'green';
            imgErrorMessage.innerHTML = '';
        } else {
            document.getElementById('img').style.borderColor = 'red';
            imgErrorMessage.innerHTML = 'Img cannot be empty';
        }
    }

    function validateVisible() {
        var visible = document.getElementById('visible').checked;
        var visibleErrorMessage = document.getElementById('visible-error-message');

        if (visible) {
            document.getElementById('visible-hidden').value = 1;
            visibleErrorMessage.innerHTML = '';
        } else {
            document.getElementById('visible-hidden').value = 0;
            visibleErrorMessage.innerHTML = '';
        }
    }
</script>
