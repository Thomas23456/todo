@extends('layouts.main')

@section('title', "Create a new board")


@section('content')
    <div class="add_board">
        <div>
            <div class="titre_board">Créer un board</div>
            <div>
                <form action="/boards" method="POST">
                    @csrf
                    <div class="component_margin">
                        <label for="title">Titre : </label>
                        <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror"/><br/>
                    </div>

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="component_margin">
                        <label for="description">Description : </label>
                        <input type='textarea' name='description' id="description"/><br/>
                    </div>
                    <button type="submit" class="component_margin button_create">Créer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="link_page">Revenir aux boards <a href="{{route('boards.index')}}">Boards</a></div>

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