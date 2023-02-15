@php use Illuminate\Support\Facades\Session; @endphp
@extends('components.layout')
@section("js")
    <script src="/js/home.js"></script>
@endsection

@section("css")
    <link rel="stylesheet" href="/css/home.css">
    <link href="/css/card.css" rel="stylesheet">
@endsection


@section('title')
    Home | Wigle
@endsection

@section('content')

    @include('nav')
    @if(Session::has('area'))
        <div class="header">
            <h1 class="heading">Featured in {{ Session::get('area') }}</h1> {{-- Shows the area selected by user --}}
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

        <div class="card-container">
            <div class="see-all-button">
                <a href="/products" class="see-all">See all</a>
            </div>
            <div class="card-flex">
                @if(Session::has("products"))
                    @foreach($products = Session::get("products")  as $product)
                        <x-card
                            title="{{ $product->product_name }}"
                            rating="{{ $product->rating}}"
                            price="{{ $product->price }}"
                            image="{{$product->image}}"
                        />
                    @endforeach
                @endif
            </div>
        </div>
        {{--    end card container --}}
    @else
        {{--    Modal pop up for selecting area--}}
        <div class="modal block" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Select your location</h1>
                    <p class="modal-tagline">Share your location and start browsing products.</p>
                </div>
                <div class="modal-selector">
                    {{--                <button class="locate-btn" id="locate-button">Detect location automatically</button>--}}
                    {{--                <p>Or</p>--}}
                    <form action="/search-pincode" method="GET">
                        @csrf
                        <label for="pin code" class="label-pincode">Enter pin code of your area:</label>
                        <input
                            type="number"
                            placeholder="Enter your pin code"
                            id="pin code"
                            class="input-pin-code"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            maxlength="6"
                            name="pincode"
                            autocomplete="on"
                        >
                        @if((Session::has('error_area')))
                            <p class="alert-red">
                                <span>
                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                    {{ Session::get('error_area') }}
                                </span>
                                <i class="bi bi-x-lg close" onclick="disableAlert()"></i>
                            </p>
                        @endif
                        <button class="proceed-btn">Proceed</button>
                    </form>

                </div>
            </div>
        </div>
    @endif

@endsection

