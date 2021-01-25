@extends('layouts.main')

@section('content')

    <main class="container">
        <h1 class="mt-5">Modifica il post: {{ $post->title }}</h1>

        {{-- errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- form --}}
        <form class="mt-5" action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
            </div>
            <div class="form-group">
                <label for="content">Testo del Post</label>
                <textarea class="form-control" name="content" id="content">{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="form-group">
                <label for="path_image">Immagine del post</label>
                @isset($post->path_image)
                    <div class="image mb-2">
                        <img width="200" src="{{ asset('storage/' . $post->path_image) }}" alt="{{ $post->title }}">
                    </div>
                    <h5>Cambia:</h5>
                @endisset
                <input type="file" name="path_image" id="path_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Modifica Post</button>
          </form>
    </main>
@endsection