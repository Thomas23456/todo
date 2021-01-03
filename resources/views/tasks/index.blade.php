@extends('layouts.main')

@section('title', "Board's tasks")


@section('content')
    @if(count($board->tasks) == 0)
    <div class="no_board">
            <div>
                <img src="{{ asset('img/warning.png') }}" alt="image warning"/>Oups ! Vous n'avez aucun board
            </div>
        </div>
        <div class="link_page">Cliquez ici pour créer un board <a href="{{route('boards.create')}}">Nouveau</a></div>
    @else
    <div>
        <div class="titre_boards">{{$board->title}}</div>
        <div class="link_page">Cliquez ici pour créer une tâche <a href="{{route('tasks.create', $board)}}">Nouvelle</a></div>
        <div class="link_page">Cliquez ici pour revenir aux boards <a href="{{route('boards.index')}}">Boards</a></div>
    </div>
    <h3>Liste des tâches</h3>
    @foreach ($board->tasks as $task)
        <p>{{ $task->title }}. 
            <a href="{{route('tasks.show', [$board, $task])}}">detail</a> <a href="{{route('tasks.edit', [$board, $task])}}">edit</a></p>
            <form action="{{route('tasks.destroy', [$board, $task])}}" method='POST'>
                @method('DELETE')
                @csrf
                
                <button type="submit">Delete</button>
            </form>
    @endforeach
    @endif
@endsection