@php use function GuzzleHttp\json_decode; @endphp
@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/productDetail.css') }}">
@endsection

@section('scriptjs')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        // let form = document.getElementById('productAddFrm');
        $('#productAddFrm').onsubmit(function (e){
            e.preventDefault();
            $.ajax({
                url: {{ url('/add-to-cart') }},
                type: 'post',
                data: $('#productAddFrm').serialize(),
                success: function (result){
                    alert('product added');
                }
            })
        })
    </script>
@endsection

@section('title')
    {{ $productinfo[0]->p_name }}
@endsection

@section('content')
    @include('nav')
    @if(session()->has('itemAdded'))
        <div class="alert">
            <p class="alert-success">{{ session()->get('itemAdded') }}</p>
        </div>
    @endif
    @if(session()->has('exists'))
        <div class="alert">
            <p class="alert-success">{{ session()->get('exists') }}</p>
        </div>
    @endif
    <div class="row">
        {{--                Image col--}}
        <div class="col">

            <img src="{{ asset('/public/images/' . $productinfo[0]->p_image) }}" alt="image" class="product-image">
        </div>
        {{--                product details--}}
        <div class="col">
            <h1 class="product-name">{{ $productinfo[0]->p_name }}</h1>
            <p class="special-price">special price</p>
            <div class="pricing-wrapper">
                <p class="strike-price">₹129</p>
                <p class="price">₹<span class="bg-txt">{{ $productinfo[0]->p_price }}/</span>per day</p>
            </div>
            <div class="rating-wrapper">
                <p class="rating">
                    {{ $productinfo[0]->p_rating }}
                    <span>
                        <i class="bi bi-star-fill star"></i>
                    </span>
                </p>
            </div>
            <form action="/add-to-cart" method="post" id="productAddFrm">
                @csrf
                <div class="size-wrapper">
                    <label class="size-label">Size</label>
                    @php $product_size = json_decode($productinfo[0]->p_size) @endphp
                    <select name="size">
                        @foreach ($product_size as $size)
                            <option class="option" value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="size-wrapper">
                    <label class="size-label">Quantity</label>
                    <select name="quantity">
                        {{--                        <option class="option" value="1" selected>1</option>--}}
                        @for($i = 1; $i<=5; $i++)
                            <option class="option" value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <input type="hidden" name="product_id" value="{{ $productinfo[0]->pid }}">
                @if($productinfo[0]->stock > 0)
                    <button class="add-to-cart">Add to cart</button>
                @else
                    <button class="out-of-stock" type="button" disabled>Out of stock</button>
                @endif
            </form>
        </div>
    </div>
@endsection
