@php use function GuzzleHttp\json_decode; @endphp
@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="/css/productDetail.css">
@endsection

@section('title')
    Product Name | Wigle
@endsection

@section('content')
    @include('nav')
    @if(session()->has('itemAdded'))
        <p>{{ session()->get('itemAdded') }}</p>
    @endif
    <div class="row">

        {{--        Image col --}}
        <div class="col">
            <img src="{{ asset('/storage/images/' . $productinfo[0]->image) }}" alt="image" class="product-image">
        </div>
        {{--        product details --}}
        <div class="col">
            <h1 class="product-name">{{ $productinfo[0]->product_name }}</h1>
            <p class="special-price">special price</p>
            <div class="pricing-wrapper">
                {{--                <p class="strike-price">₹129</p> --}}
                <p class="price">₹<span class="bg-txt">{{ $productinfo[0]->price }}/</span>per day</p>
            </div>
            <div class="rating-wrapper">
                <p class="rating">
                    {{ $productinfo[0]->rating }}
                    <span>
                        <i class="bi bi-star-fill star"></i>
                    </span>
                </p>
            </div>
            <form action="/add-to-cart" method="post">
                @csrf
                <div class="size-wrapper">
                    <label class="size-label">Size</label>
                    @php $product_size = json_decode($productinfo[0]->size) @endphp
                    <select name="size">
                        @foreach ($product_size as $size)
                            <option class="option" value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="size-wrapper">
                    <label class="size-label">Quantity</label>
                    <select name="quantity">
                        <option class="option" value="1" selected>1</option>
                        <option class="option" value="2">2</option>
                        <option class="option" value="3">3</option>
                        <option class="option" value="4">4</option>
                        <option class="option" value="5">5</option>
                    </select>
                </div>

                <input type="hidden" name="product_id" value="{{ $productinfo[0]->id }}">
                <button class="add-to-cart">Add to cart</button>
            </form>
        </div>
    </div>
@endsection
