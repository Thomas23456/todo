@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$board->title}} - {{$task->title}}</div>
    <div class="descript_board">Propriétaire : {{$board->owner->name}} - {{$board->owner->email}}</div>
    <div class="descript_board">Description : {{$task->description}}
    <p>À finir avant le  : {{$task->due_date}}</p>
    <p>Status :  {{$task->state}}</p>
    <p>Catégorie : "{{$category->name}}"</p></div>

    <div class="participants">
        <table class="table_show">
            <tr>
                <td class="titre_column">Participant de la tâche</td>
                <td class="titre_column">Supprimer le participant</td>
            </tr>
            @foreach($task->assignedUsers as $user)  
            <tr>
                <td>{{$user->name}} : {{$user->email}}</td>
                <td>
                    <form action="{{route('tasks.taskuser.destroy', $user->pivot->id)}}" method="POST" class="contain_link_table">
                        @csrf
                        @method("DELETE")
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="add_user">
        <div class="add_user_margin">Liste des utilisateurs : </div>
        <form action="{{route('tasks.taskuser.store', [$board, $task])}}" method="POST">
            @csrf
            <select name="user_id" id="user_id" class="add_user_margin">-->
                @foreach($task->participants as $participant)
                    @foreach($task->assignedUsers as $assigned)
                        @if($participant->id != $assigned->id)
                            <option value="{{$user->id}}">{{$participant->name}} : {{$participant->email}}</option>
                        @endif
                    @endforeach
                @endforeach
            </select>
            @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="add_button">Ajouter</button>
        </form>
    </div>

    <div class="link_page2">Accéder aux<a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
    <div class="link_page2">Revenir aux<a href="{{route('tasks.index', $board)}}">Tâches</a></div>
@endsection