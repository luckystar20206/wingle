@php use Illuminate\Auth\Events\Verified;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB; @endphp
@extends('components.layout')
@section('title')
    Orders | Wigle
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/account.css') }}" />
@endsection
@section('content')
    <div class="account-page">
        <div class="sidebar">
            <div class="wrapper-top-mid">
                <div class="top">
                    <h1 class="logo"><a href="/">Wigle</a></h1>
                    <div class="image-wrapper">
                        @if($userdata['profile_photo'])
                            <img alt="profile_image"
                                 src="{{ asset('storage/images/'. $userdata['profile_photo']) }}"
                                 class="profile-image"
                            >
                        @else
                            <img style="width: 40%" alt="photo" src="{{ asset('/icons/icons8-add-image-90.png') }}"
                                 onclick="document.getElementById('upload_profile_photo').click()"/>

                            <form action="/account/upload/profile_photo" method="post" id="image_upload"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="profile_photo" id="upload_profile_photo"
                                       onchange="document.getElementById('image_upload').submit()" hidden>
                            </form>

                        @endif

                    </div>
                </div>
                <ul class="mid-links">
                    <li class="link-wrapper">
                        <i class="bi bi-house-door-fill"></i>
                        <a href="/" class="link">Home</a>
                    </li>
                    <li class="link-wrapper">
                        <i class="bi bi-basket-fill"></i>
                        <a href="/products" class="link">Products</a>
                    </li>
                    <li class="link-wrapper">
                        <i class="bi bi-people-fill"></i>
                        <a href="#" class="link">About</a>
                    </li>
                    <li class="link-wrapper">
                        <i class="bi bi-envelope-paper-fill"></i>
                        <a href="/contact" class="link">Contact</a>
                    </li>
                    <li class="link-wrapper">
                        <i class="bi bi-bag-fill"></i>
                        <a href="/cart" class="link">Cart</a>
                    </li>
                    @if(\auth()->user()->role === 'admin')
                        <li class="link-wrapper">
                            <i class="bi bi-bookmark-star-fill"></i>
                            <a href="/account/" class="link">Account</a>
                        </li>
                        <li class="link-wrapper">
                            <i class="bi bi-people-fill"></i>
                            <a href="/account/users" class="link">Users</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="bottom">
                @if(!Auth::user()->hasVerifiedEmail())
                    <form method="get" action="/email/verify" style="margin-bottom: 10px;">
                        @csrf
                        <button class="verify-button">Verify Email</button>
                    </form>
                @endif
                <form method="post" action="/logout">
                    @csrf
                    <button class="logout-button">Logout</button>
                </form>
            </div>
        </div>

        <div class="container my-3 px-4">
            <h1 class="fw-bold m-1">Orders</h1>
            <table class="table table-bordered my-5 border border-2 text-center">
                <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Payment ID</th>
                    <th scope="col">Products</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category</th>
                    <th scope="col">Rent period</th>
                    <th scope="col">Total amount</th>
                    <th scope="col">Order Date & Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->payment_id }}</td>
                        <td>{{ str_replace(array( '[', ']', '"' ), '', $order->pname) }}</td>
                        <td>{{ str_replace(array( '[', ']', '"' ), '', $order->qty) }}</td>
                        <td>{{ str_replace(array( '[', ']', '"' ), '', $order->category) }}</td>
                        <td>{{ $order->rent_period }} day</td>
                        <td>Rs {{ $order->cart_total/100 }}</td>
                        <td>{{ $order->ordered_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
