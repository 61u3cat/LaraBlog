@extends('LaraBlog.layouts.app')
@section('content')
    <main class="main">
        <!-- Trending Category Section -->
        <section id="trending-category" class="trending-category section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="post-entry lg">
                            <a href="{{ route('blog-details', $posts[0]->slug) }}">
                                <img src="{{ $posts[0]->thumbnail ? asset('uploads/' . $posts[0]->thumbnail) : asset('frontend/img/default-thumbnail.jpg') }}"
                                    alt="{{ $posts[0]->title }}" class="img-fluid fixed-thumbnail">
                                {{-- Use a fallback image if the thumbnail is missing --}}
                            </a>
                            <div class="post-meta">
                                @foreach ($posts[0]->blogCategory as $cat)
                                    <span class="date">{{ $cat->getCategoryName->category_name }}</span>
                                @endforeach
                                <span>{{ $posts[0]->created_at }}</span>
                            </div>
                            <h2><a href="{{ route('blog-details', $posts[0]->slug) }}">{{ $posts[0]->title }}</a></h2>
                            <p class="mb-4 d-block">{{ Str::of($posts[0]->editor)->stripTags() }}</p>
                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="frontend/img/person-1.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="name">
                                    <h3 class="m-0 p-0">{{ $posts[0]->user->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row g-5">
                            <!-- First Column -->
                            <div class="col-lg-4 border-start custom-border">
                                @foreach ($posts->take(3) as $post)
                                    <div class="post-entry">
                                        <a href="{{ route('blog-details', $post->slug) }}">
                                            <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('frontend/img/default-thumbnail.jpg') }}"
                                                alt="{{ $post->title }}" class="img-fluid fixed-thumbnail">
                                        </a>
                                        <div class="post-meta">
                                            @foreach ($post->blogCategory as $cat)
                                                <span class="date">{{ $cat->getCategoryName->category_name }}</span>
                                            @endforeach
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <h2><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a>
                                        </h2>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Second Column -->
                            <div class="col-lg-4 border-start custom-border">
                                @foreach ($trendingCategories as $category)
                                    <div class="category-section">
                                        <h4 class="category-title">{{ $category->category_name }}</h4>
                                        @foreach ($category->posts->take(1) as $post)
                                            <div class="post-entry">
                                                <a href="{{ route('blog-details', $post->slug) }}">
                                                    <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('frontend/img/default-thumbnail.jpg') }}"
                                                        alt="{{ $post->title }}" class="img-fluid fixed-thumbnail">
                                                </a>
                                                <div class="post-meta">
                                                    <span class="date">{{ $category->category_name }}</span>
                                                    <span class="mx-1">•</span>
                                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <h2><a
                                                        href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a>
                                                </h2>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <!-- Trending Section -->
                            <div class="col-lg-4">
                                <div class="trending">
                                    <h3>Trending</h3>
                                    <ul class="trending-post">
                                        @foreach ($trendingPosts as $key => $post)
                                            <li>
                                                <a href="{{ route('blog-details', $post->slug) }}">
                                                    <span class="number">{{ $key + 1 }}</span>
                                                    <h3>{{ $post->title }}</h3>
                                                    <span class="author">{{ $post->user->name ?? 'Admin' }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Trending Category Section -->

        <!-- Category-Wise Sections -->
        @foreach ($categories as $category)
            <section id="{{ Str::slug($category->category_name) }}-category" class="category-section section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <div class="section-title-container d-flex align-items-center justify-content-between">
                        <h2>{{ $category->category_name }}</h2>
                        <p><a href="{{ route('category.posts', $category->category_slug) }}">See All
                                {{ $category->category_name }}</a></p>
                    </div>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-5">
                        @foreach ($category->posts->take(6)->chunk(3) as $chunk)
                            @foreach ($chunk as $post)
                                <div class="col-lg-4">
                                    <div class="post-list lg">
                                        <a href="{{ route('blog-details', $post->slug) }}">
                                            <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('frontend/img/default-thumbnail.jpg') }}"
                                                alt="{{ $post->title }}" class="img-fluid fixed-thumbnail">
                                            {{-- Use a fallback image if the thumbnail is missing --}}
                                        </a>
                                        <div class="post-meta">
                                            <span class="date">{{ $category->category_name }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <h2><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a>
                                        </h2>
                                        <p class="mb-4 d-block">{{ Str::limit(strip_tags($post->editor), 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    </main>
@endsection
