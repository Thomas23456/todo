@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$board->title}} - {{$task->title}} - Commentaire</div>
    <div class="descript_board">Propriétaire : {{$comment->user->name}} - {{$comment->user->email}}</div>
    <div class="descript_board">Texte : {{$comment->text}}</div>
    <div class="link_page2">Revenir aux<a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
@endsection