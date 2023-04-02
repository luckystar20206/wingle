@props(['title', 'price', 'image', 'stock'])

<form class="card" action="POSt" enctype="multipart/form-data">
    <div class="form-card">
        <div>
            <img src="{{ asset('public/images/' . $image) }}" alt="image" class="card-img">
            <input type="file" class="file">
        </div>
        <div class="card-details">
            <input class="" value="{{ $title }}">
            <input type="number" value="{{ $price }}">
            <input type="number" value="{{ $stock }}">
        </div>
    </div>
    <button type="submit">Update</button>
</form>
