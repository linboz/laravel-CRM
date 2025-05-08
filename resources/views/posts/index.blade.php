@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Blog Posts</h1>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                @forelse($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">{{ $post->title }}</a>
                                </h5>
                                <p class="card-text text-muted">
                                    <small>
                                        Categories: 
                                        @foreach($post->categories as $category)
                                            <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                        | Created: {{ $post->created_at->format('M d, Y') }}
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                                    <div class="btn-group">
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No posts found. <a href="{{ route('posts.create') }}">Create your first post</a>!
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 