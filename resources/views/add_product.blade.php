@extends('components.layout')
@section("js")

@endsection

@section('title')
    Products | Wigle
@endsection
@section("css")
    <link rel="stylesheet" href="{{ asset("/css/add_product.css") }}">
@endsection

@section("content")
    @include("nav")

    <div class="container">@if(session()->has('success'))
            <div class="success-alert">
                <p>
                    {{ session()->get('success') }}
                </p>
                <i class="bi bi-x-lg" onclick="document.querySelector('.success-alert').remove()"></i>
            </div>
        @endif
        <div class="cont-heading">{{ __("Add Product") }}</div>
        <form action="/add-product-post" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name" class="label">Enter product name</label>
                <div class="form-control">
                    <input
                        class="input"
                        type="text"
                        id="product-name"
                        name="product_name"
                        value="{{ old('product_name') }}"
                        required
                        autocomplete="product-name"
                    />

                    @error('product_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="label">Enter product image</label>
                <input
                    class="input"
                    type="file"
                    id="image"
                    name="product_image"
                    value="{{ old('product_image') }}"
                    required
                />
                @error('image')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="label">Enter price</label>
                <input
                    class="input"
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    required
                />
                @error('price')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="label">Enter price</label>
                <select name="category">
                    <option value="Mens" name="mens" selected>Mens</option>
                    <option value="Womens" name="womens">Womens</option>
                    <option value="kids" name="kids">kids</option>
                </select>
                @error('category')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="label">Enter size</label>
                <input
                    type="checkbox"
                    id="price"
                    name="size[]"
                    value="S"
                />S
                <input
                    type="checkbox"
                    id="price"
                    name="size[]"
                    value="M"
                />M
                <input
                    type="checkbox"
                    id="price"
                    name="size[]"
                    value="L"
                />L
                <input
                    type="checkbox"
                    id="price"
                    name="size[]"
                    value="XL"
                />XL
                @error('size')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="pincode" class="label">Enter pincode</label>
                <input
                    class="input"
                    type="number"
                    id="pincode"
                    name="pincode"
                    value="{{ old('pincode') }}"
                    required
                />
                @error('pincode')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="featured" class="label">Is Featured? </label>
                <input
                    class="radios"
                    type="radio"
                    id="featured"
                    name="featured"
                    value="1"
                    required
                />yes
                <input
                    class="radios"
                    type="radio"
                    id="featured"
                    name="featured"
                    value="0"
                    required
                />no
                @error('featured')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="submit-btn">
                <button type="submit" class="btn-primary">Add product</button>
            </div>

        </form>
    </div>

@endsection
