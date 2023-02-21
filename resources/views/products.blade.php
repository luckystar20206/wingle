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
            <form id="filter-form" action="/products/filter={filter}" method="get">
                <div class="filter-price">
                    <select name="filter" class="filters-price-main filter" id="select-area">
                        <option onclick="submitFilterForm()" value="all" selected>All</option>
                        <option onclick="submitFilterForm()" value="Low to High">Low to High</option>
                        <option onclick="submitFilterForm()" value="High to Low">High to Low</option>
                        <option onclick="submitFilterForm()" value="Mens">Mens</option>
                        <option onclick="submitFilterForm()" value="Womens">Womens</option>
                        <option onclick="submitFilterForm()" value="Kids">Kids</option>
                    </select>
                </div>
            </form>
        </div>
    </header>
    <div class="card-container">
        @foreach($products as  $product)
            <a style="text-decoration: none; color: #181818"
               href="/products/product_name={{$product->product_name}}&id={{$product->id}}">
                <x-card
                    image="{{ $product->image }}"
                    title="{{ $product->product_name }}"
                    rating="{{ $product->rating }}"
                    price="{{ $product->price }}"/>
            </a>
        @endforeach
    </div>
@endsection
