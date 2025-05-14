@extends('LaraBlog.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blog Post Title -->
                <h1 class="mb-3">{{ $post->title }}</h1>

                <!-- Blog Post Metadata -->
                <div class="mb-3">
                    <span class="text-muted">By {{ $post->user->name ?? 'Admin' }}</span>
                    <span class="mx-2">|</span>
                    <span class="text-muted">{{ $post->created_at->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span class="text-muted">Category:
                        @foreach ($post->blogCategory as $blogCategory)
                            {{ $blogCategory->getCategoryName->category_name ?? 'Uncategorized' }}
                           
                        @endforeach
                    </span>
                </div>

                <!-- Blog Post Thumbnail -->
                @if ($post->thumbnail)
                    <img src="{{ asset('uploads/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid mb-4">
                @endif

                <!-- Blog Post Content -->
                <div class="content">
                    {!! $post->editor !!}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <h4 class="mb-4">Recent Posts</h4>
                    <ul class="list-unstyled">
                        @foreach ($recentPosts as $recentPost)
                        
                            <li>
                                <a href="{{ route('blog-details', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
