`@extends('components.layout')
@section("js")

@endsection

@section('title')
    Add to Inventory | Wigle
@endsection

@section("css")
    <link rel="stylesheet" href="{{ asset('/css/add_product.css') }}">
@endsection

@section("content")
    @include("nav")

    <div class="container">
        @if(session()->has('message'))
            <div class="success-alert">
                <p>
                    {{ session()->get('message') }}
                </p>
                <i class="bi bi-x-lg" onclick="document.querySelector('.success-alert').remove()"></i>
            </div>
        @endif

        <div class="cont-heading">{{ __("Add Product") }}</div>
        <form action="/add-to-inventory" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name" class="label">Enter item name:</label>
                <div class="form-control">
                    <input type="text" id="product-name" name="product_name" class="input" required>
                    @error('product_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="product-image" class="label">Enter item image:</label>
                <div class="form-control">
                    <input type="file" id="product-image" name="product_image" class="input" required>
                    @error('product_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="product-price" class="label">Enter item price:</label>
                <div class="form-control">
                    <input type="number" id="product-price" name="product_price" class="input" required>
                    @error('product_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="product-size" class="label">Enter available sizes:</label>
                <div class="form-control">
                    <input type="checkbox" id="product-size" name="product_size[]" value="S" >S
                    <input type="checkbox" id="product-size" name="product_size[]" value="M" >M
                    <input type="checkbox" id="product-size" name="product_size[]" value="L" >L
                    <input type="checkbox" id="product-size" name="product_size[]" value="XL" >XL
                    @error('product_size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="product-image" class="label">Choose a category:</label>
                <div class="form-control">
                    <select name="product_category">
                        <option value="Mens">Mens</option>
                        <option value="Womens">Womens</option>
                        <option value="Kids">Kids</option>
                    </select>
                    @error('product_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="product-stock" class="label">Enter item stock:</label>
                <div class="form-control">
                    <input type="number" id="product-stock" name="product_stock" class="input" required>
                    @error('product_stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="submit-btn">
                <button type="submit" class="btn-primary">Add product</button>
            </div>
        </form>
    </div>

@endsection
