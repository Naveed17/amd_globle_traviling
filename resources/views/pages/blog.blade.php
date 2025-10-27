@extends('common.layout')
@section('content')
    <!-- Hero Section -->
    <section class="blog-hero-section">
        <h1 class="blog-hero-title"><i class="bi bi-journal-text"></i> Travel Blog</h1>
        <p class="blog-hero-subtitle">Discover amazing destinations, travel tips, and exclusive deals from around the world</p>
    </section>

    <!-- Main Content -->
    <main class="container">
        <!-- Categories -->
        <section class="categories-section mt-5">
            <div class="categories">
                <button class="category-btn active" onclick="filterCategory('all')">All Posts</button>
                @foreach($categories as $category)
                    <button class="category-btn" onclick="filterCategory('{{ $category->slug }}')">{{ $category->name }}</button>
                @endforeach
            </div>
        </section>

        <!-- Blog Grid -->
        <section class="blog-grid">
            @foreach($blogs as $blog)
                <article class="blog-card" data-category="{{ $blog->category->slug }}" onclick="openBlogDetail('{{ $blog->slug }}')">
                    <div class="blog-image">
                        <div class="blog-category">{{ $blog->category->name }}</div>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        @else
                            <i class="bi bi-{{ $blog->icon ?? 'journal-text' }}"></i>
                        @endif
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('F j, Y') }}</span>
                            <span><i class="bi bi-clock"></i> {{ $blog->reading_time }} min read</span>
                        </div>
                        <h2 class="blog-title">{{ $blog->title }}</h2>
                        <p class="blog-excerpt">{{ Str::limit($blog->excerpt, 150) }}</p>
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="read-more">
                            Read More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </section>

        <!-- Pagination -->
        <div class="blog-pagination">
            {{ $blogs->links() }}
        </div>
    </main>

    <!-- Newsletter Section -->
    <section class="blog-newsletter-section">
        <div class="blog-newsletter-card">
            <h3>Stay Updated with Latest Travel Tips!</h3>
            <p>Get exclusive deals, destination guides, and travel tips delivered to your inbox</p>
            <div class="blog-newsletter-form">
                <input type="email" class="blog-newsletter-input" placeholder="Enter your email address">
                <button class="blog-newsletter-btn">Subscribe</button>
            </div>
        </div>
    </section>

@endsection