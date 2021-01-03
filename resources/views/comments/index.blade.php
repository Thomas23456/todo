@extends('layouts.main')

@section('title', "Task's comments")


@section('content')
    <h2>{{$task->title}}</h2>
    <h3>Liste des commentaires</h3>
    @foreach ($task->comments as $comment)
        <p>Commentaire
            <a href="{{route('comments.show', [$board, $task, $comment])}}">detail</a> <a href="{{route('comments.edit', [$board, $task, $comment])}}">edit</a></p>
            <form action="{{route('comments.destroy', [$board, $task, $comment])}}" method='POST'>
                @method('DELETE')
                @csrf
                
                <button type="submit">Delete</button>
            </form>
    @endforeach
@endsection