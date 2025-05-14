@extends('LaraBlog.layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ $category->category_name }}</h1>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-lg-4 mb-4">
                <div class="post-list">
                    <a href="{{ route('blog-details', $post->slug) }}">
                        @if ($post->thumbnail)
                            <img src="{{ asset('uploads/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid">
                        @endif
                    </a>
                    <div class="post-meta">
                        <span class="date">{{ $category->category_name }}</span>
                        <span class="mx-1">•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a></h2>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection