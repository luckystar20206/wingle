@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/updateProduct.css') }}">
    <link href="{{ asset('/css/updateCard.css') }}" rel="stylesheet">

@endsection

@section('content')
    @include('nav')

    <div class="container">
        <h1 class="heading">Update products</h1>
        <div class="product-container">
            @foreach($products as $product)
                <x-updateCard
                    image="{{ $product->image }}"
                    title="{{ $product->product_name }}"
                    rating="{{ $product->rating }}"
                    price="{{ $product->price }}"
                    id="{{ $product->id }}"
                />
            @endforeach
        </div>
    </div>
@endsection
