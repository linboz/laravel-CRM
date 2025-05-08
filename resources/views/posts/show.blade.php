@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <article class="card">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                        class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="card-title h2">{{ $post->title }}</h1>
                            <p class="text-muted">
                                Posted in 
                                @foreach($post->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                on {{ $post->created_at->format('F j, Y') }}
                            </p>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </article>

            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Posts</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach(\App\Models\Category::withCount('posts')->get() as $category)
                            <li class="mb-2">
                                <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                    {{ $category->name }}
                                    <span class="badge bg-secondary float-end">{{ $category->posts_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection 