@props(['title', 'rating', 'price'])

<div class="card">
    <img src="https://source.unsplash.com/1200x800/?shirt" alt="image" class="card-img">
    <div class="card-details">
        <h1 class="card-title">{{ $title }}</h1>
        <p class="rating">
            {{ $rating }}
            <span>
                    <i class="bi bi-star-fill"></i>
                </span>
        </p>
        <div class="pricing-cont">
            <h1 class="price"><span class="txt-bg">₹{{ $price }}</span>/per day</h1>
            <div class="horizontal-line"></div>
            <a href="/products/1"><h1 class="add-to-cart">Add to cart</h1></a>
        </div>
    </div>
</div>

