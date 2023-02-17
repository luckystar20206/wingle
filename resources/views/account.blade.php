@php use Illuminate\Auth\Events\Verified;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB; @endphp
@extends('components.layout')

@section('js')

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/account.css') }}">
@endsection
@section('content')
    @if(session()->has('request_pending'))
        <div class="warning-alert">
            <p>
                {{ session()->get('request_pending') }}
            </p>
            <i class="bi bi-x-lg" onclick="document.querySelector('.warning-alert').remove()"></i>
        </div>
    @endif
    <div class="account-page">
        <div class="sidebar">
            <div class="wrapper-top-mid">
                <div class="top">
                    <h1 class="logo"><a href="/">Wigle</a></h1>
                    <div class="image-wrapper">
                        @if($user[0]->profile_photo)
                            <img alt="profile_image"
                                 src="{{ asset('storage/images/'. $user[0]->profile_photo) }}"
                                 class="profile-image"
                            >
                        @else
                            <img style="width: 40%" alt="photo" src="{{ asset('/icons/icons8-add-image-90.png') }}"
                                 onclick="document.getElementById('upload_profile_photo').click()" />

                            <form action="/account/upload/profile_photo" method="post" id="image_upload" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="profile_photo" id="upload_profile_photo"  onchange="document.getElementById('image_upload').submit()" hidden>
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
                    <li class="link-wrapper">
                        <i class="bi bi-bookmark-star-fill"></i>
                        <a href="/account/list_admin_requests" class="link">Admin Requests</a>
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
                    @if(session()->has('changes_success'))
                        <div class="success-alert">
                            <p>
                                <strong>Success!</strong>
                                {{ session()->get('changes_success') }}
                            </p>
                            <i class="bi bi-x-lg" onclick="document.querySelector('.success-alert').remove()"></i>
                        </div>
                    @endif
                    @if(session()->has('success_request'))
                        <div class="success-alert">
                            <p>
                                <strong>Success!</strong>
                                {{ session()->get('success_request') }}
                            </p>
                            <i class="bi bi-x-lg" onclick="document.querySelector('.success-alert').remove()"></i>
                        </div>
                    @endif
                    @if(session()->has('request_exists'))
                        <div class="warning-alert btm">
                            <p>
                                {{ session()->get('request_exists') }}
                            </p>
                            <i class="bi bi-x-lg" onclick="document.querySelector('.btm').remove()"></i>
                        </div>
                    @endif
                    <form action="/account/save-changes" method="post" style="display: flex; flex-wrap: wrap">
                        @csrf
                        <div class="field-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $user[0]->name }}" name="username" id="name" disabled required>
                        </div>
                        <div class="field-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $user[0]->email }}" name="email" id="email" disabled required>
                        </div>
                        <div class="field-group">
                            <div class="label-wrapper">
                                <label for="password">Password</label>
                            </div>
                            <a href="/password/reset" type="button" class="reset-pass-btn" name="password"
                               id="password">Reset password</a>
                        </div>
                        <div class="field-group">
                            <label for="phone">Phone</label>
                            <input type="tel" value="{{ $user[0]->phone }}" name="phone" id="phone" disabled required>
                        </div>
                        <div class="field-group">
                            <label for="address">Address</label>
                            <input type="text" value="{{ $user[0]->address}}"
                                   placeholder="Enter your delivery address"
                                   name="address"
                                   id="address">
                        </div>
                        <div class="field-group">
                            <label style="visibility: hidden">Save your changes</label>
                            <button type="submit" class="save-button">Save changes</button>
                        </div>
                    </form>
                </div>
                @if(\auth()->user()->role === 'admin')
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
                            <a href="/account/request-admin-access">
                                <div class="card green">
                                    <div class="card-details">
                                        <h1 class="title">Request Admin Access</h1>
                                        <p class="desc">Features like add, update, remove products and other special
                                            rights which can be only accessed by site admins only, to maintain the
                                            site.</p>
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
