@extends('LaraBlog.layouts.app')
@section('content')
<div class="container">
     <h3>Search Results for "{{ $query }}"</h3>
    @if($posts->count())
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('frontend/img/default-thumbnail.jpg') }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('blog-details', $post->slug) }}">{{ $post->title }}</a></h5>
                            <p class="card-text">{{ Str::limit(strip_tags($post->editor), 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    @else
        <p>No results found.</p>
    @endif
</div>
@endsection