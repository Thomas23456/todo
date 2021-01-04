@extends('layouts.main')

@section('title', "Create a new task")


@section('content')
    <div class="add_task">
        <div>
            <div class="titre_board">Créer une tâche</div>
            <div>
                <form action="{{route('tasks.store', $board)}}" method="POST">
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
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="component_margin">
                        <label for="due_date">Date de fin : </label>
                        <input type='date' name='due_date' id="due_date"/><br/>
                    </div>

                    <div class="component_margin">
                        <label for="category">Catégorie : </label>
                        <select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>      
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <button type="submit" class="component_margin button_create">Créer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="link_page">Revenir aux<a href="{{route('tasks.index', $board)}}">Tâches</a></div>
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