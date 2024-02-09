@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/updatePage.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/updateCard.css') }}">
@endsection

@section('content')
    @include('nav')

    <div class="container">
        <h1 class="heading">Remove products</h1>
        <div class="product-container">
            @foreach($products as $product)
                <x-removeCard
                    image="{{ $product->p_image }}"
                    title="{{ $product->p_name }}"
                    price="{{ $product->p_price }}"
                    id="{{ $product->pid }}"
                    area="{{ $product->pincode }}"
                />
            @endforeach
        </div>
    </div>

@endsection
