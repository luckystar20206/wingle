@extends('components.layout')

@section("css")
    <link rel="stylesheet" href="/css/cart.css">
@endsection

@section('title')
    Cart | Wigle
@endsection

@section('content')
    @include('nav')

    <h1 class="heading">Your Cart</h1>

    <div class="cart-table">
        <div class="item-card">
            <div class="col">
                <img src="https://source.unsplash.com/800x600/?shirt" alt="image" class="item-image">
                <div class="item-details">
                    <h2 class="item-name">Men black colour round neck t-shirt</h2>
                    <p class="size"><strong>Size</strong>: M</p>
                    <div class="quantity-wrapper">
                        <label for="select-qty">Qty</label>
                        <select class="quantity-selection" id="select-qty">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="renting-period-wrapper">
                        <label class="title">Number of days (rent period):</label>
                        <select class="renting-days-selection">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="price-w-day">
                        <span class="red-clr">*</span><span class="txt-bg">₹79/</span>per day
                    </div>
                </div>
            </div>
            <div class="final-price">
                <p class="price">₹<span class="txt-bg">79</span></p>
            </div>
        </div>
        <div class="item-card">
            <div class="col">
                <img src="https://source.unsplash.com/800x600/?shirt" alt="image" class="item-image">
                <div class="item-details">
                    <h2 class="item-name">Men black colour round neck t-shirt</h2>
                    <p class="size"><strong>Size</strong>: M</p>
                    <div class="quantity-wrapper">
                        <label for="select-qty">Qty</label>
                        <select class="quantity-selection" id="select-qty">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="renting-period-wrapper">
                        <label class="title">Number of days (rent period):</label>
                        <select class="renting-days-selection">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="price-w-day">
                        <span class="red-clr">*</span><span class="txt-bg">₹79/</span>per day
                    </div>
                </div>
            </div>
            <div class="final-price">
                <p class="price">₹<span class="txt-bg">79</span></p>
            </div>
        </div>
        <div class=""
    </div>
@endsection
