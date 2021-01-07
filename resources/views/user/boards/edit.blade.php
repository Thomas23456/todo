@extends('layouts.main')

@section('title', "Edit board" . $board->title)

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('content')
    <div class="add_board">
        <div>
            <div class="titre_board">Editer un board</div>
            <div>
                <form action="{{route('boards.update', $board)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="component_margin">
                        <label for="title">Titre : </label>
                        <input id="title" name="title" type="text" class="@error('title') is-invalid @enderror" value="{{$board->title}}">
                    </div>

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="component_margin">
                        <label for="description">Description : </label>
                        <input type='textarea' name='description' id="description" value="{{$board->description}}">
                    </div>
                    <input type='text' name='user_id' id="user_id" value="{{$board->owner->id}}" class="hidden_input">
                    <button type="submit" class="component_margin button_create">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="link_page">Revenir aux<a href="{{route('boards.index')}}">Boards</a></div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection