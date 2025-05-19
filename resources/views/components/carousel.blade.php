<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
.carousel-container {
    max-width: 750px;
    margin: 0 auto;
    background: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 2px 16px #0001;
    padding: 1.5rem 1rem 2.5rem 1rem;
}
.carousel-slide {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 2rem;
    padding: 1.2rem 0.5rem;
}
.carousel-slide img {
    width: 220px;
    height: 140px;
    object-fit: cover;
    border-radius: 0.8rem;
    box-shadow: 0 2px 8px #0001;
}
.carousel-slide-content {
    flex: 1;
}
.carousel-slide-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #23272f;
}
.carousel-slide-desc {
    color: #64748b;
    margin-bottom: 1rem;
}
.carousel-slide-btn {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 0.5rem;
    padding: 0.5rem 1.2rem;
    font-weight: 500;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
}
.carousel-slide-btn:hover {
    background: #1746a2;
}
.swiper-pagination-bullet {
    background: #2563eb;
}
</style>
<div class="carousel-container">
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($items as $item)
                <div class="swiper-slide">
                    <div class="carousel-slide">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <div class="carousel-slide-content">
                            <div class="carousel-slide-title">{{ $item['title'] }}</div>
                            <div class="carousel-slide-desc">{{ $item['description'] }}</div>
                            @if(isset($item['button']))
                                <a href="{{ $item['button']['url'] }}" class="carousel-slide-btn">{{ $item['button']['label'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.swiper', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        slidesPerView: 1,
        spaceBetween: 30,
        breakpoints: {
            700: { slidesPerView: 1 },
            900: { slidesPerView: 1 }
        }
    });
});
</script>
