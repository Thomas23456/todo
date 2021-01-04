@extends('layouts.main')

@section('title', "Task " .  $task->title)


@section('content')
    <div class="titre_boards">{{$board->title}} - {{$task->title}} - Commentaire</div>
    <div class="descript_board">Propriétaire : {{$board->owner->name}} - {{$board->owner->email}}</div>
    <div class="descript_board">Texte : {{$comment->text}}</div>
    <div class="link_page2">Revenir aux<a href="{{route('comments.index', [$board, $task])}}">Commentaires</a></div>
@endsection