@extends('layouts.main')

@section('title', "Create a new comment")


@section('content')
    <div class="add_com">
        <div>
            <div class="titre_board">Créer un commentaire</div>
            <div>
                <form action="{{route('comments.store', [$board, $task])}}" method="POST">
                    @csrf
                    <div class="component_margin">
                        <label for="text">Texte : </label>
                        <input type='textarea' name='text' id="text"/><br/>
                    </div>
                    @error('text')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            
                    <button type="submit" class="component_margin button_create">Créer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="link_page">Revenir aux<a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection