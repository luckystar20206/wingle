@php use Illuminate\Auth\Events\Verified;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB; @endphp
@extends('components.layout')
@section('title')
    Admin Requests | Wigle
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/account.css') }}">
@endsection
@section('content')
    <div class="account-page">
        <div class="sidebar">
            <div class="wrapper-top-mid">
                <div class="top">
                    <h1 class="logo"><a href="/">Wigle</a></h1>
                    <div class="image-wrapper"></div>
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
                        <a href="/account" class="link">Account</a>
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
        <div class="container my-3 px-4">
            <h1 class="fw-bold m-1">Users</h1>
            <p class="m-0 w-50 text-light-emphasis ">List of all the users who have signed up to wigle.
                It also shows details about their status.</p>
            <table class="table table-bordered my-5 border border-2 text-center">
                <thead>
                <tr>
                    <th scope="col">User id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td><p class="{{ $user->role }}">{{ $user->role }}</p></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
