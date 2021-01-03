@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$board->title}} - {{$task->title}}</div>
    <div class="descript_board">Description : {{$task->description}}
    <p>À finir avant le  : {{$task->due_date}}</p>
    <p>Status :  {{$task->state}}</p></div>
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
    <div class="link_page2">Cliquez ici pour accéder aux commentaires <a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
    <div class="link_page2">Revenir aux tâches <a href="{{route('tasks.index', $board)}}">Tâches</a></div>
@endsection