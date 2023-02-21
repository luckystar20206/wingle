@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/checkout.css') }}">
@endsection

@section('title')
    Checkout | Wigle
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="brand">
        <a href="/" class="logo">Wigle</a>
        <a href="{{ url()->previous() }}"><i class="bi bi-box-arrow-left"></i></a>
    </div>
    <div class="container">
        <div class="details-cont">
            <form>
                @csrf
                
            </form>
        </div>
        <div class="order-cont"></div>
    </div>
@endsection
