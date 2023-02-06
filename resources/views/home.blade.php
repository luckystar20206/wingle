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

    {{--    Modal pop up for selecting area--}}
    <div class="modal block" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Select your location</h1>
                <p class="modal-tagline">Share your location and start browsing products.</p>
            </div>
            <div class="modal-selector">
                <p class="modal-selector-tagline">Select your area of residence*</p>
                <select class="selection" id="select">
                    <option selected value="selected">Select</option>
                    <option value="Makarpura">Makarpura</option>
                    <option value="Manjalpur">Manjalpur</option>
                    <option value="Karelibaug">Karelibaug</option>
                    <option value="Ajwa">Ajwa</option>
                </select>
            </div>
        </div>
    </div>
    {{--    Card container -> Displays products--}}
    <div class="header">
        <h1 class="heading">Featured in Makarpura</h1> {{-- Makarpura will be dynamic --}}
        <select class="filters-area" id="select-area">
            <option selected value="selected">Select</option>
            <option value="Makarpura">Makarpura</option>
            <option value="Manjalpur">Manjalpur</option>
            <option value="Karelibaug">Karelibaug</option>
            <option value="Ajwa">Ajwa</option>
        </select>
    </div>
    <div class="see-all-button">
        <a href="/products" class="see-all">See all</a>
    </div>
    <div class="card-container">
        <x-card title="Mens black jacket" rating="4.3" price="89"/>
        <x-card title="Mens black jacket" rating="4.3" price="89"/>
        <x-card title="Mens black jacket" rating="4.3" price="89"/>
        <x-card title="Mens black jacket" rating="4.3" price="89"/>
        <x-card title="Mens black jacket" rating="4.3" price="89"/>
    </div>
    {{--    end card container --}}
@endsection

