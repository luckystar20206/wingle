@php use App\Models\Cart;use Illuminate\Support\Facades\Auth; @endphp
@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/checkout.css') }}">
@endsection

@section('js')
    <script defer src="{{ asset('/js/checkout.js') }}"></script>
@endsection

@section('title')
    Checkout | Wigle
@endsection

@section('content')
    <div class="brand">
        <a href="/" class="logo">Wigle</a>
        <a href="{{ url('/cart') }}"><i class="bi bi-box-arrow-left"></i></a>
    </div>
    <div class="container">
        <div class="details-cont">
            <div class="content">
                <h1 class="heading">Verify your details</h1>
                <form action="/pay" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input id="name" class="form-control" name="name" type="text" value="{{ $userdetails->name }}"
                               placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <input id="email" class="form-control" name="email" type="email"
                               value="{{ $userdetails->email }}"
                               placeholder="Enter your email address"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Delivery Address</label>
                        <input id="addressByText" class="form-control" name="address" type="text"
                               value="{{ $userdetails->address }}"
                               placeholder="Enter your delivery address"
                               onchange="showAddressViaMap()"
                               required>
                    </div>
                    <div class="view-total">
                        <p class="sub-total-text">Subtotal</p>
                        <p class="sub-total-price">₹{{ $subtotal }}</p>
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    </div>
                    <div id="location-hidden"></div>
                    <button type="submit" class="pay-button" id="paybutton" onclick="activate()">
                        <span class="text">Make payment</span>
                        <span class="loader d-none"></span>
                    </button>
                </form>
            </div>
        </div>
        <div class="order-cont" id="orderContainer">
            <div class="maps">
                <iframe
                    width="100%"
                    height="100%"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    id="gmap_canvas"
                    src=""
                >
                </iframe>
                <br/>
            </div>
            <div class="order-summary">
                <h1 class="title">Order Summary</h1>
                @php $totalAmount = 0 @endphp
                @foreach($cartItems as $cartItem)
                    <div class="detail-wrapper">
                        <p>{{ $cartItem->pname }}</p>
                        <p>{{ $cartItem->item_total }}</p>
                    </div>
                    @php
                        $totalAmount+= $cartItem->item_total;
                    @endphp
                @endforeach
                <div class="detail-wrapper subtotal">
                    <p>Items Total:</p>
                    <p>{{ $totalAmount }}</p>
                </div>
                <div class="detail-wrapper">
                    <p>Deposit:</p>
                    <p>Rs. 299</p>
                </div>
                <div class="detail-wrapper subtotal">
                    <p>Subtotal:</p>
                    <p>Rs. {{ $subtotal }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
