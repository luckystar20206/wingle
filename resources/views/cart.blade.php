@php use App\Models\Product; @endphp
@extends('components.layout')

@section("css")
    <link rel="stylesheet" href="{{ asset('/css/cart.css')}}">
@endsection

@section('title')
    Cart | Wigle
@endsection

@section('content')
    @php $totalAmount = 0; @endphp
    @include('nav')
    @if(session()->has("success"))
        <p>{{ session()->get("success") }}</p>
        @php session()->remove("success") @endphp
    @elseif(session()->has("failed"))
        <p>{{ session()->get("failed") }}</p>
        @php session()->remove("failed") @endphp
    @elseif(session()->has("order-confirmed"))
        <p>{{ session()->get("order-confirmed") }}</p>
        @php session()->remove("order-confirmed") @endphp
    @endif
    <h1 class="heading">Your Cart</h1>
    <div class="cart-table">
        @foreach($cart_items as $item)
            <div class="item-card">
                <div class="col">
                    <img src="{{ asset('/public/images/' . $item->image) }}" alt="image" class="item-image">
                    <div class="item-details">
                        <h2 class="item-name">{{ $item->pname }}</h2>
                        <p class="size"><strong>Size</strong>: {{ $item->size }}</p>
                        <form class="update_qty_form" action="/update-item-quantity-in-cart" method="post">
                            @csrf
                            <div class="quantity-wrapper">
                                <label for="select-qty">Qty</label>
                                <select name="qty" onchange="form.submit()" class="quantity-selection">
                                    <option value="1" {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                </select>
                            </div>
                            <input type="hidden" name="pid" value="{{ $item->pid }}">
                            <input type="hidden" name="price" value="{{ $item->price }}">
                            <input type="hidden" name="rent_period" value="{{ $item->rent_period }}">
                        </form>
                        <form action="/update-rent-period-in-cart" method="post">
                            @csrf
                            <div class="renting-period-wrapper">
                                <label class="title">Number of days (rent period):</label>
                                <select onchange="form.submit()" name="rent_period" class="renting-days-selection">
                                    <option value="1" {{ $item->rent_period == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $item->rent_period == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $item->rent_period == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $item->rent_period == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $item->rent_period == 5 ? 'selected' : '' }}>5</option>
                                </select>
                                <input type="hidden" name="pid" value="{{ $item->pid }}">
                                <input type="hidden" name="qty" value="{{ $item->qty }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                            </div>
                            <input type="hidden" name="pid" value="{{ $item->pid }}">
                        </form>
                        <div class="price-w-day">
                            <span class="red-clr">*</span><span class="txt-bg">₹{{ $item->price }}/</span>per day
                        </div>
                        <form action="/remove-item-from-cart" method="post">
                            @csrf
                            <input type="hidden" name="pid" value="{{ $item->pid }}">
                            <button class="remove-btn" type="submit">Remove</button>
                        </form>
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
                    <td class="field"><span>Items Total</span><span>:</span></td>
                    <td class="value">Rs.
                        @php
                            for ($i=0; $i<$items_in_cart; $i++){
                                $totalAmount += $cart_items[$i]->item_total;
                            }
                            echo $totalAmount;
                        @endphp

                    </td>
                </tr>
                <tr>
                    <td class="field"><span>Deposit</span><span>:</span></td>
                    <td class="value">₹{{$deposit = 299}}</td>
                </tr>
                <tr>
                    <td class="field"><span>Cart Total</span><span>:</span></td>
                    <td class="value">₹{{ $totalAmount + $deposit  }}</td>
                </tr>
                <tr>
                    <td class="field"></td>
                    <td class="value pt">
                        <form action="/checkout" method="post">
                            @csrf
                            <input type="hidden" name="subtotal" value="{{ $totalAmount + $deposit  }}">
                            <button type="submit" class="checkout-btn">Checkout</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
