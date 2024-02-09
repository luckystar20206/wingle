`@extends('components.layout')
@section("js")

@endsection

@section('title')
    Products | Wigle
@endsection

@section("css")
    <link rel="stylesheet" href="{{ asset('/css/add_product.css') }}">
@endsection

@section("content")
    @include("nav")

    <div class="container">
        @if(session()->has('message'))
            <div class="success-alert">
                <p>
                    {{ session()->get('message') }}
                </p>
                <i class="bi bi-x-lg" onclick="document.querySelector('.success-alert').remove()"></i>
            </div>
        @endif

        <div class="cont-heading">{{ __("Add Product") }}</div>
        <form action="/add-product-post" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name" class="label">Select a product</label>
                <div class="form-control">

                    <select name="pid">
                        <option selected value="default" disabled>Select</option>
                        @foreach($inventory as $item)
                            <option value="{{ $item->pid }}">{{ $item->p_name }}</option>
                        @endforeach
                    </select><br>

                    @error('pid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="pincode" class="label">Select a pincode</label>
                <div class="form-control">
                    <select name="pincode">
                        <option selected value="default" disabled>Select</option>
                        @foreach($pincode as $pin)
                            <option value="{{ $pin->pincode }}">{{ $pin->pincode}} -> {{ $pin->area_name }}</option>
                        @endforeach
                    </select><br>

                    @error('pincode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="submit-btn">
                <button type="submit" class="btn-primary">Add product</button>
            </div>

        </form>
    </div>

@endsection
