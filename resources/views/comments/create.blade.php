@extends('layouts.main')

@section('title', "Create a new comment")


@section('content')
    <p>Add a comment </p>
    <div>
        <form action="{{route('comments.store', [$board, $task])}}" method="POST">
            @csrf
            
            <label for="text">Description</label>
            <input type='textarea' name='text' id="text" >
            @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit">Create</button>
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