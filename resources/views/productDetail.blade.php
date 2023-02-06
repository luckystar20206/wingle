@extends('components.layout')

@section("css")
    <link rel="stylesheet" href="/css/productDetail.css">
@endsection

@section('title')
    Product Name | Wigle
@endsection

@section('content')
    @include('nav')

    <div class="row">
        {{--        Image col --}}
        <div class="col">
            <img src="https://source.unsplash.com/1200x800/?shirts" alt="image" class="product-image">
        </div>
        {{--        product details --}}
        <div class="col">
            <h1 class="product-name">Cotton men's shirt</h1>
            <p class="special-price">special price</p>
            <div class="pricing-wrapper">
                <p class="strike-price">₹200</p>
                <p class="price">₹<span class="bg-txt">99/</span>per day</p>
            </div>
            <div class="rating-wrapper">
                <p class="rating">
                    4.4
                    <span>
                    <i class="bi bi-star-fill star"></i>
                </span>
                </p>

            </div>
            <div class="size-wrapper">
                    <label class="size-label">Size</label>
                <div class="boxes">
                    <div class="size-box">S</div>
                    <div class="size-box">M</div>
                    <div class="size-box">L</div>
                    <div class="size-box">XL</div>
                </div>
            </div>
            <button class="add-to-cart">Add to cart</button>
        </div>
    </div>
@endsection
