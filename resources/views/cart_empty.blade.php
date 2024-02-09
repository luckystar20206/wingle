@php use function GuzzleHttp\json_decode; @endphp
@extends('components.layout')

@section('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500&display=swap');

        .container {
            width: 80%;
            margin: auto;
            padding: 20px 0;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: "Nunito Sans", sans-serif;
        }

        .container a {
            color: #ffffff;
            font-size: 20px;
            background-color: black;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>

@endsection

@section('title')
    Cart | Wigle
@endsection

@section('content')
    @include('nav')
    <div class="container">
        <h1>Oops! Your cart is empty</h1>
        <a href="/products">Add items</a>
    </div>
@endsection
