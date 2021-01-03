@extends('layouts.main')

@section('title', "Update a comment")


@section('content')
    <p>Add a board </p>
    <div>
        <form action="{{route('comments.update', [$board, $task, $comment])}}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="text">Commentaire</label>
            <input type='textarea' name='text' id="text"  value="{{$comment->text}}">
            @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit">Update</button>
        </form>

    </div>
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