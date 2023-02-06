@extends('components.layout')
@section("js")
    <script src="/js/product.js"></script>
@endsection

@section('title')
    Products | Wigle
@endsection
@section("css")
    <link rel="stylesheet" href="/css/product.css">
    <link href="/css/card.css" rel="stylesheet">
@endsection

@section('content')
    @include('nav')

    <header>
        <h1 class="heading">Order this from Makarpura</h1>
        <div class="filter-cont">
            <div class="filters-area">
                <select class="filters-area-main filter" id="select-area">
                    <option selected value="selected">Select</option>
                    <option value="Makarpura">Makarpura</option>
                    <option value="Manjalpur">Manjalpur</option>
                    <option value="Karelibaug">Karelibaug</option>
                    <option value="Ajwa">Ajwa</option>
                </select>
            </div>
            <div class="filter-price">
                <select class="filters-price-main filter" id="select-area">
                    <option selected value="all">All</option>
                    <option value="Low to High">Low to High</option>
                    <option value="High to Low">High to Low</option>
                    <option value="Mens">Mens</option>
                    <option value="Womens">Womens</option>
                    <option value="Kids">Kids</option>
                </select>
            </div>
        </div>
    </header>
    <div class="card-container">
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
        <x-card title="Black mens shirt" rating="4.4" price="99"/>
    </div>
@endsection
