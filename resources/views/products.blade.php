@extends('components.layout')
@section("js")
    <script defer src="/js/product.js"></script>
@endsection

@section('title')
    Products | Wigle
@endsection
@section("css")
    <link rel="stylesheet" href="{{ asset("/css/product.css") }}">
    <link href="/css/card.css" rel="stylesheet">
@endsection

@section('content')
    @include('nav')

    <header>
        <h1 class="heading">Order this from {{ session()->get('area') }}</h1>
        <div class="filter-cont">
            <div class="filters-area">
                <div class="display-area">
                    <form action="/change-area" method="GET">
                        <div class="dropdown-area">
                            <div class="dropdown-input">
                                <input value="{{ Session::get('area') }}" class="show_area" disabled/>
                                <i class="bi bi-chevron-down arrow-up"></i>
                            </div>
                            <div class="dropdown-content d-none">
                                <button class="change-area-btn">Change area</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{--            price filters --}}
            <div class="display-area">
                <form action="/products/price-filter" method="GET">
                    <div class="dropdown-area">
                        <select onclick="form.submit()" class="dropdown-input" name="filter" style="cursor: pointer">
                            <option value="all" selected>All</option>
                            <option value="ASC">Low to high</option>
                            <option value="DESC">High to low</option>
                            <option value="Mens">Mens</option>
                            <option value="Womens">Womens</option>
                            <option value="Kids">Kids</option>  
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <div class="card-container">
        @foreach($products as $product)
            <a style="text-decoration: none; color: #181818"
               href="/products/product_name={{$product->p_name}}&id={{$product->pid}}">
               
                <x-card
                    image="{{ $product->p_image }}"
                    title="{{ $product->p_name }}"
                    price="{{ $product->p_price }}"
                />
            </a>
        @endforeach
    </div>
@endsection
