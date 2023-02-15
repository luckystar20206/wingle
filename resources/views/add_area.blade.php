@php use Illuminate\Support\Facades\Session; @endphp
@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="/css/add_area.css">
@endsection

@section('content')
    @include('nav')
    @if(Session::has('added'))
        <p>Area added successfully</p>
    @endif
    <div class="center">
        <form action="/add-area-req" method="post">
            @csrf
            <label for="area">Enter the area name:</label>
            <input class="input" id="area" name="area_name" type="text">
            <button type="submit" class="submit">Add</button>
        </form>
    </div>
@endsection
