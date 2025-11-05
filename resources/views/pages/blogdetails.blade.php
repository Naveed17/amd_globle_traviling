@extends('common.layout')
@section('content')


    <!-- Hero Section -->
    <section class="blog-detail-hero">
        <div class="blog-hero-content">
            <div class="blog-category-hero">{{ $blog->category->name }}</div>
            <h1 class="blog-detail-title">{{ $blog->title }}</h1>
            <!-- <div class="blog-meta-detail">
                <div class="meta-item">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    <span>{{ $blog->reading_time }} min read</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span>{{ $blog->author->name }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-eye"></i>
                    <span>{{ number_format($blog->views) }} views</span>
                </div>
            </div> -->
            <!-- <div class="share-buttons">
                <button class="share-btn" onclick="sharePost('facebook')">
                    <i class="bi bi-facebook"></i>
                </button>
                <button class="share-btn" onclick="sharePost('twitter')">
                    <i class="bi bi-twitter"></i>
                </button>
                <button class="share-btn" onclick="sharePost('linkedin')">
                    <i class="bi bi-linkedin"></i>
                </button>
                <button class="share-btn" onclick="sharePost('whatsapp')">
                    <i class="bi bi-whatsapp"></i>
                </button>
            </div> -->
        </div>
    </section>

    <!-- Featured Image Section -->
    <section class="blog-featured-image">
        <div class="image-container">
            @if($blog->featured_image)
                <img class="featured-img img-fluid" src="{{ asset('storage/app/public/' . $blog->featured_image) }}" 
                     alt="{{ $blog->title }}" 
                     class="featured-img">
            @else
                <div class="placeholder-image">
                    <i class="bi bi-image"></i>
                </div>
            @endif
            @if($blog->image_caption)
                <div class="image-caption">
                    <i class="bi bi-camera"></i>
                    <span>{{ $blog->image_caption }}</span>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <main class="blog-main-content">
        <!-- Article Content -->
        <article class="article-content">
            <div class="article-body">
                {!! processImages($blog->content) !!}
            </div>
        </article>


      

        <!-- Post Navigation -->
        <nav class="post-navigation">
            @if($previousPost)
            <a href="{{ route('blog.detail', $previousPost->slug) }}" class="nav-post previous">
                <div class="nav-label">← Previous Post</div>
                <div class="nav-title">{{ $previousPost->title }}</div>
            </a>
            @endif
            
            @if($nextPost)
            <a href="{{ route('blog.detail', $nextPost->slug) }}" class="nav-post next">
                <div class="nav-label">Next Post →</div>
                <div class="nav-title">{{ $nextPost->title }}</div>
            </a>
            @endif
        </nav>
    </main>

    <script>
        // Share Functions
        function sharePost(platform) {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.querySelector('.blog-detail-title').textContent);
            
            let shareUrl;
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        // Smooth scroll for TOC
        document.querySelectorAll('.toc-list a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start',
                        inline: 'nearest'
                    });
                    
                    // Update URL without page reload
                    history.pushState(null, null, `#${targetId}`);
                }
            });
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight current section in TOC when scrolling
            const sections = document.querySelectorAll('article h2[id], article h3[id]');
            const tocLinks = document.querySelectorAll('.toc-list a');
            
            window.addEventListener('scroll', function() {
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 200) {
                        current = section.getAttribute('id');
                    }
                });
                
                tocLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection