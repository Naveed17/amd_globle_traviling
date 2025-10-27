<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Dynamic Meta Title --}}
    <title>{{ getSetting('meta_title', 'seo', 'Default Title') }}</title>

    {{-- Dynamic Meta Description --}}
    <meta name="description" content="{{ getSetting('meta_description', 'seo', 'Default description here...') }}">

    {{-- Dynamic Meta Keywords --}}
    <meta name="keywords" content="{{ getSetting('keywords', 'seo', '') }}">

    {{-- Open Graph (for social sharing) --}}
    <meta property="og:title" content="{{ getSetting('meta_title', 'seo', 'Default OG Title') }}">
    <meta property="og:description" content="{{ getSetting('meta_description', 'seo', 'Default OG Description') }}">
    <meta property="og:image" content="{{ getSettingImage('business_logo', 'branding') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ getSetting('meta_title', 'seo', 'Default Twitter Title') }}">
    <meta name="twitter:description" content="{{ getSetting('meta_description', 'seo', 'Default Twitter Description') }}">
    <meta name="twitter:image" content="{{ getSettingImage('business_logo', 'branding') }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ getSettingImage('favicon', 'branding') }}" type="image/png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/bootstrap-5.3.6-dist/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- select to -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Flatpickr -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <!-- style.css -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/style.css') }}">

    <style>
        .bh-hero-section {
            background: linear-gradient(135deg, rgba(0, 82, 254, 0.4), rgba(0, 65, 204, 0.5)), url('{{url('public/assets/images/hero-flights.jpg')}}') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            min-height: 70vh;
            position: relative;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modern-navbar {
            background: transparent !important;
         
            border-bottom: none;
            box-shadow: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: -1px;
            left: 0;
            right: 0;
            z-index: 1050;
            padding: .5rem 0;
            min-height: 60px;
        }
        
        
        
        .bh-hero-section {
            padding-top: 90px;
        }
        
        .modern-navbar.scrolled {
            background: linear-gradient(135deg, #0041CC 0%, #0052FF 50%, #0041CC 100%) !important;
            backdrop-filter: blur(40px);
            padding: 0.5rem 0;
            min-height: 60px;
            box-shadow: 0 4px 20px rgba(0, 65, 204, 0.6);
        }
        
        .modern-navbar.scrolled::before {
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%, rgba(255, 255, 255, 0.05) 100%);
        }
        
      
        
        .modern-navbar.scrolled .nav-link {
            padding: 0.6rem 1rem !important;
            font-size: 0.85rem;
        }
        
        
        .modern-navbar .container-fluid {
            position: relative;
            z-index: 2;
        }
        
        .modern-navbar .navbar-brand {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 3;
        }
        
        .modern-navbar .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ffffff, transparent);
            transition: all 0.4s ease;
            transform: translateX(-50%);
        }
        
        .modern-navbar .navbar-brand:hover {
            transform: scale(1.08) translateY(-2px);
        }
        
        .modern-navbar .navbar-brand:hover::after {
            width: 100%;
        }
        
        .modern-navbar .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600;
            padding: 0.8rem 1.2rem !important;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin: 0 0.2rem;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        
       
        
        .modern-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #ffffff, #e0e7ff, #ffffff);
            transition: all 0.4s ease;
            transform: translateX(-50%);
        }
        
        .modern-navbar .nav-link:hover::before {
            left: 100%;
        }
        
        .modern-navbar .nav-link:hover::after {
            width: 80%;
        }
        
       
        
        .modern-navbar .navbar-toggler {
            border: none;
            padding: 0.5rem;
            background: transparent;
            position: relative;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }
        
        .modern-navbar .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .hamburger {
            width: 24px;
            height: 18px;
            position: relative;
            margin: auto;
        }
        
        .hamburger span {
            display: block;
            position: absolute;
            height: 2px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 2px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: 0.25s ease-in-out;
        }
        
        .hamburger span:nth-child(1) {
            top: 0px;
        }
        
        .hamburger span:nth-child(2) {
            top: 8px;
        }
        
        .hamburger span:nth-child(3) {
            top: 16px;
        }
        
        .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(1) {
            top: 8px;
            transform: rotate(135deg);
        }
        
        .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(2) {
            opacity: 0;
            left: -60px;
        }
        
        .navbar-toggler[aria-expanded="true"] .hamburger span:nth-child(3) {
            top: 8px;
            transform: rotate(-135deg);
        }
        
        .mobile-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1055;
        }
        
        .mobile-backdrop.show {
            opacity: 1;
            visibility: visible;
        }
        
        @media (max-width: 991.98px) {
            .modern-navbar .navbar-collapse {
                position: fixed;
                top: 0;
                right: -350px;
                width: 350px;
                height: 100vh;
                background: linear-gradient(135deg, rgba(0, 30, 100, 0.95) 0%, rgba(0, 65, 204, 0.95) 100%);
                border-left: 1px solid rgba(255, 255, 255, 0.2);
                padding: 2rem 0;
                box-shadow: -20px 0 50px rgba(0, 0, 0, 0.5);
                transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1060;
                overflow-y: auto;
            }
            
            .mobile-close-btn {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .mobile-close-btn:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: scale(1.1);
            }
            
            .modern-navbar .navbar-collapse.show {
                right: 0;
            }
            
            .modern-navbar .navbar-collapse.collapsing {
                right: -350px;
                transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .modern-navbar .navbar-nav {
                padding: 2rem 1.5rem 0;
            }
            
            .modern-navbar .nav-item {
                margin: 0.5rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .modern-navbar .nav-item:last-child {
                border-bottom: none;
            }
            
            .modern-navbar .nav-link {
                color: rgba(255, 255, 255, 0.9) !important;
                padding: 1.2rem 1.5rem !important;
                text-align: left;
                border-radius: 0;
                background: transparent;
                border: none;
                transition: all 0.3s ease;
                text-transform: uppercase;
                font-size: 0.95rem;
                font-weight: 600;
                letter-spacing: 1px;
                display: flex;
                align-items: center;
                position: relative;
            }
            
            .modern-navbar .nav-link::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
                background: #fff;
                transform: scaleY(0);
                transition: transform 0.3s ease;
            }
            
            .modern-navbar .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #fff !important;
                padding-left: 2rem !important;
            }
            
            .modern-navbar .nav-link:hover::before {
                transform: scaleY(1);
            }
            
            .modern-navbar .nav-link::after {
                display: none;
            }
        }
        .navbar-brand {
            position: relative;
            z-index: 3;
            height:52px;
            width: 120px;
        }
        .navbar-brand img {
           object-fit: cover;
    object-position: center;
    clip-path: inset(-17% 0% 48% 4%);
    transform: scale(1.5);
    height: 100%;
    width: 100%;
    position: absolute;
    top: 12px;
    transition:all .3s

        }
      .modern-navbar.scrolled img {
         transform: scale(1.3);   
        }  
        
       
    </style>
</head>

<body>
    <!-- Ultra Modern Navigation Bar -->
    <nav class="navbar navbar-expand-lg modern-navbar navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                 <img src="{{ getSettingImage('business_logo','branding') }}" 
                    alt="TravelBookingPanel Logo" 
                    class="img-fluid" 
                    >
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#modernNavbar"
                aria-controls="modernNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            
            <div class="mobile-backdrop" id="mobileBackdrop"></div>
            
            <div class="collapse navbar-collapse" id="modernNavbar">
                <div class="mobile-close-btn d-lg-none" id="mobileCloseBtn">
                    <i class="bi bi-x-lg"></i>
                </div>
                <ul class="navbar-nav ms-auto align-items-center">
                    @foreach (get_menu_items('header') as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $item->full_url }}">{{ $item->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.modern-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Mobile menu backdrop functionality
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('#modernNavbar');
        const mobileBackdrop = document.querySelector('#mobileBackdrop');
        const mobileCloseBtn = document.querySelector('#mobileCloseBtn');
        
        // Listen for Bootstrap collapse events
        navbarCollapse.addEventListener('shown.bs.collapse', function() {
            mobileBackdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
        
        navbarCollapse.addEventListener('hidden.bs.collapse', function() {
            mobileBackdrop.classList.remove('show');
            document.body.style.overflow = '';
        });
        
        mobileBackdrop.addEventListener('click', function() {
            navbarToggler.click();
        });
        
        mobileCloseBtn.addEventListener('click', function() {
            navbarToggler.click();
        });
    </script>
