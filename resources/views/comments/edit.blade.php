@extends('layouts.main')

@section('title', "Update a comment")


@section('content')
<div class="add_com">
        <div>
            <div class="titre_board">Editer un commentaire</div>
            <div>
                <form action="{{route('comments.update', [$board, $task, $comment])}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="component_margin">
                        <label for="text">Texte : </label>
                        <input type='textarea' name='text' id="text" value="{{$comment->text}}"/><br/>
                    </div>
                    @error('text')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <button type="submit" class="component_margin button_create">Update</button>
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