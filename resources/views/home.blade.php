@extends('common.layout')
@section('content')

<style>
    .home-flight-search-form{
        width:100%
    }
    
    /* Airline Marquee Section */
    .airline-marquee-section {
        padding: 4rem 0;
        background: #fff;
        position: relative;
        overflow: hidden;
    }
    
    .airline-marquee-section .section-header {
        margin-bottom: 3rem;
    }
    
    .airline-marquee-section .section-header h2 {
        color: #333;
        font-weight: 600;
        font-size: 2rem;
    }
    
    .airline-marquee-section .section-header p {
        color: #666;
        font-size: 1rem;
    }
    
    .marquee-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 2rem 0;
        
        border-radius: 10px;
    }
    
    .marquee-content {
        display: flex;
        animation: marquee 60s linear infinite;
        gap: 3rem;
        align-items: center;
        width: calc(200% + 6rem);
    }
    
    .airline-logo {
        flex-shrink: 0;
        width: 160px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    
    .airline-logo:hover {
        transform: translateY(-3px);
    }
    
    .airline-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: grayscale(20%);
        transition: filter 0.3s ease;
    }
    
    .airline-logo:hover img {
        filter: grayscale(0%);
    }
    
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(calc(-50% - 1.5rem));
        }
    }
    
    .marquee-container:hover .marquee-content {
        animation-play-state: paused;
    }
    
    @media (max-width: 768px) {
        .airline-marquee-section {
            padding: 3rem 0;
        }
        
        .airline-marquee-section .section-header h2 {
            font-size: 1.8rem;
        }
        
        .marquee-container {
            margin: 0 1rem;
            padding: 1.5rem 0;
        }
        
        .airline-logo {
            width: 130px;
            height: 85px;
            padding: 0.8rem;
        }
        
        .marquee-content {
            gap: 2rem;
        }
    }
</style>
<!-- hero section -->
<section class="bh-hero-section">
    <div class="home-flight-search-form">
    @include('serach-forms.flight_search')
 </div>
</section>


<!-- ppopuper destination -->
<div class="container">
    <div class="section-header pt-5">
        <h2 class="mb-0">Popular Destinations</h2>
        <a href="#" class="see-all">See All</a>
    </div>

    <div class="row">
        <!-- Destination 1 - Melbourne -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="destination-card">
                <img src="{{url('public/assets/images/melbourne.webp')}}" class="card-image" alt="Melbourne">
                <div class="card-content">
                    <div class="destination-title">Melbourne</div>
                    <div class="destination-description">An amazing journey</div>
                    <div class="destination-price">€700</div>
                    <button class="btn-book">Book Flight</button>
                </div>
            </div>
        </div>

        <!-- Destination 2 - Paris -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="destination-card">
                <img src="{{url('public/assets/images/paris.webp')}}" class="card-image" alt="Paris">
                <div class="card-content">
                    <div class="destination-title">Paris</div>
                    <div class="destination-description">A Paris Adventure</div>
                    <div class="destination-price">€600</div>
                    <button class="btn-book">Book Flight</button>
                </div>
            </div>
        </div>

        <!-- Destination 3 - London -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="destination-card">
                <img src="{{url('public/assets/images/london.webp')}}" class="card-image" alt="London">
                <div class="card-content">
                    <div class="destination-title">London</div>
                    <div class="destination-description">London eye adventure</div>
                    <div class="destination-price">€350</div>
                    <button class="btn-book">Book Flight</button>
                </div>
            </div>
        </div>

        <!-- Destination 4 - Columbia -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="destination-card">
                <img src="{{url('public/assets/images/columbia.webp')}}" class="card-image" alt="Columbia">
                <div class="card-content">
                    <div class="destination-title">Columbia</div>
                    <div class="destination-description">Amazing streets</div>
                    <div class="destination-price">€700</div>
                    <button class="btn-book">Book Flight</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- hotels deals -->
<div class="container my-5">
    <div class="section-header">
        <h2 class="mb-0">Hot Deals</h2>
        <a href="#" class="see-all">See All</a>
    </div>
    <div class="card-slider position-relative">
        <div class="arrow-btn arrow-left" id="prevBtn">
            <img src="{{url('public/assets/images/left.png')}}" width="10px">
        </div>
        <div class="arrow-btn arrow-right" id="nextBtn">
            <img src="{{url('public/assets/images/right.png')}}" width="10px">
        </div>

        <div class="card-carousel d-flex" id="cardCarousel">
            <!-- Card 1 -->
            <div class="card-item px-2">
                <div class="card">
                    <img src="{{url('public/assets/images/slider1.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Pay Per Deal</h6>
                        <p class="card-text">The concept of a "Per Day Deal" presents an enticing opportunity...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card-item px-2">
                <div class="card">
                    <img src="{{url('public/assets/images/slider2.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Pay Per Deal</h6>
                        <p class="card-text">The concept of a "Per Day Deal" presents an enticing opportunity...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card-item px-2">
                <div class="card">
                    <img src="{{url('public/assets/images/slider3.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Pay Per Deal</h6>
                        <p class="card-text">The concept of a "Per Day Deal" presents an enticing opportunity...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card-item px-2">
                <div class="card">
                    <img src="{{url('public/assets/images/slider1.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Pay Per Deal</h6>
                        <p class="card-text">The concept of a "Per Day Deal" presents an enticing opportunity...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- latest offer section -->
<div class="container bh-offer-section">
    <!-- First Row: Heading and Button -->
    <div class="row bh-offer-heading">
        <div class="col">
            <h2>Latest Offers</h2>
        </div>
        <div class="col-auto">
            <a href="#" class="bh-see-all-link text-decoration-none fw-bold">See All</a>
        </div>
    </div>
    <!-- Second Row: Two Images -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="bh-image-card" style="background-image: url('{{url('public/assets/images/offer1.webp')}}');"></div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="bh-image-card" style="background-image: url('{{url('public/assets/images/offer2.webp')}}');">
            </div>
        </div>
    </div>
</div>

<!-- airline partners marquee section -->
<div class="airline-marquee-section">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h2 class="mb-2">Our Airline Partners</h2>
            <p class="text-muted">Trusted by leading airlines worldwide</p>
        </div>
    
    <div class="marquee-container">
        <div class="marquee-content">
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_1.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_2.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_3.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_5.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_6.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_7.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_8.webp')}}" alt="Airline Partner">
            </div>
            <!-- Duplicate for seamless loop -->
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_1.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_2.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_3.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_5.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_6.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_7.webp')}}" alt="Airline Partner">
            </div>
            <div class="airline-logo">
                <img src="{{url('public/assets/images/airline/logo_img_8.webp')}}" alt="Airline Partner">
            </div>
        </div>
    </div>
    </div>
</div>


@endsection