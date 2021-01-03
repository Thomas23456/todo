@extends('layouts.main')

@section('title', "Task's comments")


@section('content')
    @if(count($task->comments) == 0)
        <div class="no_board">
            <div>
                <img src="{{ asset('img/warning.png') }}" alt="image warning"/>Oups ! Vous n'avez aucun com
            </div>
        </div>
        <div class="link_page">Cliquez ici pour créer un commentaire <a href="{{route('comments.create', [$board, $task])}}">Nouveau</a></div>
    @else
        <div>
            <div class="titre_boards">{{$board->title}} - {{$task->title}}</div>
            <div class="link_page">Revenir aux<a href="{{route('tasks.index', $board)}}">Tâches</a></div>
        </div>
        <div class="contain_table"><table class="table_boards">
        <tr>
            <td class="titre_column">Nom du commentaire</td>
            <td class="titre_column">Accéder aux détails</td>
            <td class="titre_column">Accéder à l'édition</td>
            <td class="titre_column">Supprimer le commentaire</td>
        </tr>

        @foreach ($task->comments as $comment)
        <tr>
            <td>
                "Commentaire" 
            </td>
            <td>
                <div class="contain_link_table"><a href="{{route('comments.show', [$board, $task, $comment])}}">Détails</a></div>
            </td>
            <td>
                <div class="contain_link_table2"><a href="{{route('comments.edit', [$board, $task, $comment])}}">Editer</a></div>
            </td>
            <td>
                <form action="{{route('comments.destroy', [$board, $task, $comment])}}" method='POST' class="contain_link_table">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table></div>
    <div class="link_page">Ajouter<a href="{{route('comments.create', [$board, $task])}}">Nouveau commentaire</a></div>
    @endif
@endsection