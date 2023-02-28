@extends('components.layout')

@section("css")
    <link rel="stylesheet" href="{{ asset('/css/cart.css')}}">
@endsection

@section("js")
    <script defer src="{{ asset('/js/cart.js') }}"></script>
@endsection

@section('title')
    Cart | Wigle
@endsection

@section('content')
    @include('nav')
    <h1 class="heading">Your Cart</h1>
    <div class="cart-table">
        @foreach($cart_items as $item)
            <div class="item-card">
                <div class="col">
                    <img src="{{ asset('/storage/images/' . $item->image) }}" alt="image" class="item-image">
                    <div class="item-details">
                        <h2 class="item-name">{{ $item->pname }}</h2>
                        <p class="size"><strong>Size</strong>: {{ $item->size }}</p>
                        <form id="update_qty_form" action="/update-item-quantity-in-cart" method="post">
                            @csrf
                            <div class="quantity-wrapper">
                                <label for="select-qty">Qty</label>
                                <select name="qty" onclick="submitQtyForm()" class="quantity-selection" id="select-qty">
                                    <option value="{{ $item->qty }}">{{ $item->qty }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <input type="hidden" name="pid" value="{{ $item->pid }}">
                        </form>
                        <form id="update_rentperiod_form" action="/update-rent-period-in-cart" method="post">
                            @csrf
                            <div class="renting-period-wrapper">
                                <label class="title">Number of days (rent period):</label>
                                <select onclick="submitRentForm()" name="rent_period" class="renting-days-selection">
                                    <option value="{{ $item->rent_period }}">{{ $item->rent_period }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <input type="hidden" name="pid" value="{{ $item->pid }}">
                        </form>
                        <div class="price-w-day">
                            <span class="red-clr">*</span><span class="txt-bg">₹{{ $item->price }}/</span>per day
                        </div>
                    </div>
                </div>
                <div class="final-price">
                    <p class="price">(price * rent period * quantity)</p>
                    <p class="price">₹<span
                            class="txt-bg">{{ $itemtotal = $item->price*$item->rent_period*$item->qty }}</span></p>
                </div>
            </div>
        @endforeach
        {{--   View cart total   --}}
        <div class="total-container">
            <table>
                <tr>
                    <td class="field"><span>Item Total</span><span>:</span></td>
                    <td class="value">₹{{ $itemtotal }}</td>
                </tr>
                <tr>
                    <td class="field"><span>Deposit</span><span>:</span></td>
                    <td class="value">₹{{$deposit = 299}}</td>
                </tr>
                <tr>
                    <td class="field"><span>Cart Total</span><span>:</span></td>
                    <td class="value">₹{{ $itemtotal + $deposit  }}</td>
                </tr>
                <tr>
                    <td class="field"></td>
                    <td class="value pt">
                        <form action="/checkout" method="post">
                            @csrf
                            <input type="hidden" name="subtotal" value="{{ $itemtotal + $deposit  }}">
                            <button type="submit" class="checkout-btn">Checkout</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
