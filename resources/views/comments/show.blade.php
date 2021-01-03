@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$task->title}}</div>
    <div class="descript_board">Texte : {{$comment->text}}</div>
    <div class="participants">
        @foreach($task->assignedUsers as $user) 
            <p>{{$user->name}} : {{$user->email}}</p>
            {{-- <form action="{{route('boards.boarduser.destroy', $user->pivot)}}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit">Supprimer</button>
            </form> --}}
        @endforeach
    </div>
    <div class="link_page2">Revenir aux commentaires <a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
@endsection