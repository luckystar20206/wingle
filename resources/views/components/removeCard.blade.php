@props(['title', 'price', 'image', 'id', 'area'])

<div class="card">
    <img src="{{ asset("/public/images/". $image) }}" alt="image" class="card-img">
    <div class="card-details">
        <form action="/remove-product" method="post">
            @csrf
            <input type="hidden" value="{{ $id }}" name="pid">
            <div class="pricing-cont">
                <label class="label">Product Name</label>
                <input name="product_name" type="text" class="card-title" value="{{ $title }}" required disabled/>
            </div>
            <div class="pricing-cont">
                <label class="label">Pincode</label>
                <input name="product_area" type="text" class="card-title" value="{{ $area }}" required disabled />
            </div>
            <div class="pricing-cont">
                <label class="label">Price</label>
                <input name="product_price" type="text" value="{{ $price }}" class="price" required disabled/>
            </div>
            <button type="submit" class="remove-button">Remove</button>
        </form>
    </div>
</div>

