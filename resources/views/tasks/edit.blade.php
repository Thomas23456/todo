@extends('layouts.main')

@section('title', "Update a task")


@section('content')
<div class="update_task">
        <div>
            <div class="titre_board">Créer une tâche</div>
            <div>
                <form action="{{route('tasks.update', [$board, $task])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="component_margin">
                        <label for="title">Titre : </label>
                        <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror" value="{{$task->title}}"><br/>
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="component_margin">
                        <label for="description">Description : </label>
                        <input type='textarea' name='description' id="description"  value="{{$task->description}}"><br/>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="component_margin">
                        <label for="due_date">Date de fin : </label>
                        <input type='date' name='due_date' id="due_date"  value="{{$task->due_date}}"/><br/>
                    </div>
                    
                    <div class="component_margin">
                        <label for="category">Catégorie : </label>
                        <select name="category_id" id="category_id" value="{{$task->category_id}}">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="component_margin">
                        <label for="state">Etat : </label>
                        <select name="state" id="state" value="{{$task->state}}">
                            @foreach (['todo', 'ongoing', 'done'] as $state)
                            <option value="{{$state}}">{{$state}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <button type="submit" class="component_margin button_create">Update</button>
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