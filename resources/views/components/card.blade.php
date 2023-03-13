@props(['title', 'price', 'image'])

<div class="card">
    <img src="{{ asset("public/images/". $image) }}" alt="image" class="card-img">
    <div class="card-details">
        <h1 class="card-title">{{ $title }}</h1>
        <div class="pricing-cont">
            <h1 class="price"><span class="txt-bg">₹{{ $price }}</span>/per day</h1>
        </div>
    </div>
</div>

