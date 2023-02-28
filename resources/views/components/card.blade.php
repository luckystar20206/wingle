@props(['title', 'rating', 'price', 'image'])

<div class="card">
    <img src="{{ asset("public/images/". $image) }}" alt="image" class="card-img">
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
            <!-- <div class="horizontal-line"></div>
            <button class="add-to-cart">Add to cart</button> -->
        </div>
    </div>
</div>

