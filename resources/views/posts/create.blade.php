@extends('layouts.main')

@section('content')

    <main class="container">
        <h1 class="mt-5">Crea un nuovo Post</h1>

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
        <form class="mt-5" action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="content">Testo del Post</label>
                <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="path_image">Immagine del post</label>
                <input type="file" name="path_image" id="path_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Crea Post</button>
          </form>
    </main>
    
@endsection