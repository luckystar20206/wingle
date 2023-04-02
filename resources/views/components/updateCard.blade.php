@props(['title', 'rating', 'price', 'image', 'id', 'stock', 'area'])

<div class="card">
    <img src="{{ asset("/public/images/". $image) }}" alt="image" class="card-img">
    <div class="card-details">
        <form action="/update-product" method="post">
            @csrf
            <input type="hidden" value="{{ $id }}" name="pid">
            <div class="pricing-cont">
                <label class="label">Product Name</label>
                <input name="product_name" type="text" class="card-title" value="{{ $title }}" required>
            </div>
            <div class="pricing-cont">
                <label class="label">Price</label>
                <input name="product_price" type="number" value="{{ $price }}" class="price" required/>
            </div>
            <div class="pricing-cont">
                <label class="label">Pincode</label>
                <input name="product_area" type="number" value="{{ $area }}" class="price" required/>
            </div>
            <div class="pricing-cont">
                <label class="label">Stock</label>
                <input name="stock" type="number" value="{{ $stock }}" class="price"/ required>
            </div>
            <button type="submit" class="update-button">Update</button>
        </form>
    </div>
</div>

