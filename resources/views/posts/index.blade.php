@extends('layouts.main')

@section('content')

    <main class="container">
        <ul class="list-group list-group-flush">
            @forelse ($posts as $post)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        {{ $post->title }} - {{ $post->created_at->format('d/m/Y') }}
                    </a>
                    <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-primary">Modifica</a>
                </li> 
            @empty
                <h3>Non sono disponibili articoli. <a href="{{ route('posts.create') }}">Crea un articolo ora</a></h3>
            @endforelse
        </ul>
    </main>
    
@endsection