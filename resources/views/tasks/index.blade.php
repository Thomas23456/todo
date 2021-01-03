@extends('layouts.main')

@section('title', "Board's tasks")


@section('content')
    @if(count($board->tasks) == 0)
        <div class="no_board">
            <div>
                <img src="{{ asset('img/warning.png') }}" alt="image warning"/>Oups ! Vous n'avez aucune tâche
            </div>
        </div>
        <div class="link_page">Cliquez ici pour créer une tâche <a href="{{route('tasks.create', $board)}}">Nouvelle</a></div>
    @else
        <div>
            <div class="titre_boards">{{$board->title}}</div>
            <div class="link_page">Cliquez ici pour créer une tâche <a href="{{route('tasks.create', $board)}}">Nouvelle</a></div>
            <div class="link_page">Cliquez ici pour revenir aux boards <a href="{{route('boards.index')}}">Boards</a></div>
        </div>
        <div class="contain_table"><table class="table_boards">
        <tr>
            <td class="titre_column">Nom de la tâche</td>
            <td class="titre_column">Accéder aux détails</td>
            <td class="titre_column">Accéder à l'édition</td>
            <td class="titre_column">Supprimer la tâche</td>
        </tr>

        @foreach ($board->tasks as $task)
        <tr>
            <td>
                "{{ $task->title }}" 
            </td>
            <td>
                <div class="contain_link_table"><a href="{{route('tasks.show', [$board, $task])}}">Détails</a></div>
            </td>
            <td>
                <div class="contain_link_table"><a href="{{route('tasks.edit', [$board, $task])}}">Editer</a></div>
            </td>
            <td>
                <form action="{{route('tasks.destroy', [$board, $task])}}" method='POST' class="contain_link_table">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table></div>
    @endif
@endsection