{{-- from bootstrap https://getbootstrap.com/docs/5.0/components/carousel/--}}
<div id="carouselProduct{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($product->ProductImages as $product_image)
            <div class="carousel-item @if($loop->index == 0) active @endif">
                <img src="{{ asset('product_images/'.$product_image->image) }}" class="d-block w-100"
                     height="{{ $height_in_px ?? 150 }}px" @isset($width_in_px) width="{{ $width_in_px ?? 150 }}px" @endisset alt="{{ $product->name }}">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselProduct{{ $product->id }}"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button"
            data-bs-target="#carouselProduct{{ $product->id }}"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

