@extends('common.layout')
@section('content')


   <!-- Legal Page Header -->
    <section class="legal-hero-section">
        <div class="container">
            <div class="legal-hero-content">
                <div class="legal-breadcrumb">
                    <a href="{{url('home')}}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span><?= $page->name; ?></span>
                </div>
                <h1 class="legal-hero-title"><?= $page->name; ?></h1>
                <!-- <p class="legal-hero-subtitle">Your privacy matters to us. Learn how we collect, use, and protect your personal information.</p> -->
                <div class="legal-meta">
                    <div class="legal-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>Last Updated: <?= date('F j, Y', strtotime($page->updated_at)); ?></span>
                    </div>
                    <!-- <div class="legal-meta-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>GDPR Compliant</span>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="legal-content-section">
        <div class="container">
                <!-- Main Content -->
                <div class="legal-main">
                    <div class="legal-document">
                        <?= $page->content; ?>
                    </div>
                </div>
        </div>
    </section>
 

@endsection
