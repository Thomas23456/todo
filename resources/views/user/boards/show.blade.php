@extends('layouts.main')

@section('title', "User's board " . $board->title)


@section('content')
    <div class="titre_boards">{{$board->title}}</div>
    <div class="descript_board">Propriétaire : {{$board->owner->name}} - {{$board->owner->email}}</div>
    @if($board->owner->id === $owner->id)    
        <div class="descript_board owner_form">Transférer la propriété du board à
            <form action="{{route('boards.update', $board)}}" method="POST" class="contain_owner_form">
                @csrf
                @method('PUT')    
                <select name="user_id" id="user_id" class="add_user_margin">
                    @foreach($board->users as $user)
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
        </div>
    @endif
    <div class="descript_board">Description : {{$board->description}}</div>
    <div class="participants">
        <table class="table_show">
            <tr>
                <td class="titre_column">Participant du board</td>
                <td class="titre_column">Supprimer le participant</td>
            </tr>
            @foreach($board->users as $user) 
            <tr>
                <td>{{$user->name}} : {{$user->email}}</td>
                <td>
                    <form action="{{route('boards.boarduser.destroy', $user->pivot->id)}}" method="POST" class="contain_link_table">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="add_user">
        <div class="add_user_margin">Liste des utilisateurs : </div>
        <form action="{{route('boards.boarduser.store', $board)}}" method="POST">
            @csrf
            <select name="user_id" id="user_id" class="add_user_margin">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}} : {{$user->email}}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="add_button">Ajouter</button>
        </form>
    </div>
    <div class="link_page2">Accéder aux<a href="{{route('tasks.index', $board)}}">Tâches</a></div>
    <div class="link_page2">Revenir aux<a href="{{route('boards.index')}}">Boards</a></div>
@endsection