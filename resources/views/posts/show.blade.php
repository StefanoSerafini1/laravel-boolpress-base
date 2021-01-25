@extends('layouts.main')

@section('content')

    <main class="container">
        <h1>{{ $post->title }}</h1>
        <h4>{{ $post->created_at->diffForHumans() }}</h4>

        <img width="500" src="{{ asset('storage/' . $post->path_image) }}" alt="{{ $post->title }}">
        <h5>Contenuto del post:</h5>
        <p>{{ $post->content }}</p>
        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-primary">Modifica</a>
    </main>
    
@endsection