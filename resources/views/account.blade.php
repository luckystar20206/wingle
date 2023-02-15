@php use Illuminate\Auth\Events\Verified;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB; @endphp
@extends('components.layout')

@section('js')

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/account.css') }}">
@endsection
@section('content')
    <div class="account-page">
        <div class="sidebar">
            <div class="wrapper-top-mid">
                <div class="top">
                    <h1 class="logo"><a href="/">Wigle</a></h1>
                    <div class="image-wrapper">
                        <img alt="profile_image"
                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZmlsZSUyMHBob3RvfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                             class="profile-image">
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
        <div class="right">
            <header>
                <h1 class="title">Account Details</h1>
            </header>
            <div class="user-info-wrapper">
                <h2>User Information</h2>
                <p>Here you can edit your account details about yourself.
                    The changes shall take few minutes to be displayed.</p>
            </div>
            <div class="user-admin-wrapper">
                <div class="user-details-wrapper">
                    <div class="field-group">
                        <label for="name">Name</label>
                        <input type="text" value="Archan RD" name="username" id="name" disabled required>
                    </div>
                    <div class="field-group">
                        <label for="email">Email</label>
                        <input type="email" value="archanrd29@gmail.com" name="email" id="email" disabled required>
                    </div>
                    <div class="field-group">
                        <div class="label-wrapper">
                            <label for="password">Password</label>
                            <a href="/password/reset">Forgot password</a>
                        </div>
                        <input type="password" value="password" name="password" id="password" disabled required>
                    </div>
                    <div class="field-group">
                        <label for="phone">Phone</label>
                        <input type="email" value="1233456789" name="phone" id="phone" disabled required>
                    </div>
                    <div class="field-group">
                        <label for="address">Address</label>
                        <input type="email" value="" placeholder="Enter your delivery address" name="address"
                               id="address">
                    </div>
                </div>
                @if($role = DB::select("select role from users where role = 'admin'"))
                    <div class="admin-wrapper">
                        <h1 style="margin: 0 0 20px 0">Admin Tools</h1>
                        <div class="card-container">
                            <a href="/add-product">
                                <div class="card green">
                                    <div class="card-details">
                                        <h1 class="title">Add Product</h1>
                                        <p class="desc">Add a product to your catalog by mentioning details name, price,
                                            image, pincode.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="card blue">
                                    <div class="card-details">
                                        <h1 class="title">Update Product</h1>
                                        <p class="desc">Update product details such as name, price,
                                            image, pincode, featured.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="card red">
                                    <div class="card-details">
                                        <h1 class="title">Remove Product</h1>
                                        <p class="desc">Remove the products from the catalog that are out of stock.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="admin-wrapper">
                        <h1 style="margin: 0 0 20px 0">Admin Tools</h1>
                        <div class="card-container">
                            <a href="/request-admin-access">
                                <div class="card green">
                                    <div class="card-details">
                                        <h1 class="title">Request Admin Access</h1>
                                        <p class="desc">Features like  add, update, remove products and other special rights which can be only accessed by site admins only, to maintain the site.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection
