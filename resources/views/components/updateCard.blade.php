@props(['title', 'rating', 'price', 'image', 'id'])

<div class="card">
    <img src="{{ asset("storage/images/". $image) }}" alt="image" class="card-img">
    <div class="card-details">
        <form action="/update-product" method="post">
            @csrf
{{--            <label class="">Product Name</label>--}}
{{--            <input type="text" class="card-title" value="{{ $title }}">--}}
            <input type="hidden" value="{{ $id }}" name="pid">
            <div class="pricing-cont">
                <label class="">Product Name</label>
                <input name="product_name" type="text" class="card-title" value="{{ $title }}">
            </div>
            <div class="pricing-cont">
                <label>Rs</label>
                <input name="product_price" type="text" value="{{ $price }}" class="price"/>
            </div>
            <button type="submit" class="update-button">Update</button>
        </form>
    </div>
</div>

