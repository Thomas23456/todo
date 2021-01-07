@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$board->title}} - {{$task->title}}</div>
    <div class="descript_board">Propriétaire : {{$board->owner->name}} - {{$board->owner->email}}</div>
    <div class="descript_board owner_form">Transférer la propriété de la tâche à
        @if($board->owner->id === $owner->id)
            <form action="{{route('boards.update', $board)}}" method="POST" class="contain_owner_form">
                @csrf
                @method('PUT')    
                <select name="user_id" id="user_id" class="add_user_margin">
                    @foreach($task->assignedUsers as $user)
                        @if($user->id != $board->owner->id)
                            <option value="{{$user->id}}">{{$user->name}} : {{$user->email}}</option>
                        @endif
                    @endforeach
                </select>
                @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input id="title" name="title" type="text" class="hidden_input" value="{{$board->title}}">
                <input id="description" name='description' type="textarea" class="hidden_input" value="{{$board->description}}">
                <button type="submit">Editer</button>
            </form>
        @endif
        <div class="add_info_margin">Attention ! Vous perdrez le proppriété du board également.</div>
    </div>
    <div class="descript_board">Description : {{$task->description}}
    <p>À finir avant le  : {{$task->due_date}}</p>
    <p>Status :  {{$task->state}}</p>
    <p>Catégorie : "{{$task->category->name}}"</p></div>

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
            <select name="participant_id" id="participant_id" class="add_user_margin">
                @foreach($task->participants as $participant)
                    @if(!in_array($participant->id, array_column(json_decode($task->assignedUsers, true), 'id')))
                        <option value="{{$participant->id}}">{{$participant->name}} : {{$participant->email}}</option>  
                    @endif
                @endforeach
            </select>
            @error('participant_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="add_button">Ajouter</button>
        </form>
    </div>

    <div class="link_page2">Accéder aux<a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
    <div class="link_page2">Revenir aux<a href="{{route('tasks.index', $board)}}">Tâches</a></div>
@endsection