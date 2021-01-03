@extends('layouts.main')

@section('title', "User's board")


@section('content')
    @if(count($boards) == 0)
        <div class="no_board">
            <div>
                <img src="{{ asset('img/warning.png') }}" alt="image warning"/>Oups ! Vous n'avez aucun board
            </div>
        </div>
        <div class="link_page">Cliquez ici pour créer un board <a href="{{route('boards.create')}}">Nouveau</a></div>
    @else
    <div>
        <div class="titre_boards">Tous les boards s'affichent ici</div>
        <div class="link_page">Revenir au<a href="{{route('dashboard')}}">Dashboard</a></div>
    </div>
    <div class="contain_table"><table class="table_boards">
        <tr>
            <td class="titre_column">Nom de la board</td>
            <td class="titre_column">Accéder aux détails</td>
            <td class="titre_column">Accéder à l'édition</td>
            <td class="titre_column">Supprimer la board</td>
        </tr>
        @foreach ($boards as $board)
        <tr>
            <td>
                "{{ $board->title }}" 
            </td>
            <td>
                @can('view', $board)
                    <div class="contain_link_table"><a href="{{route('boards.show', $board)}}">Détails</a></div>
                @endcan 
            </td>
            <td>
                @can('update', $board)
                <div class="contain_link_table2"><a href="{{route('boards.edit', $board)}}">Editer</a></div>
                @endcan
            </td>
            <td>
                @can('delete', $board)
                    <form action="{{route('boards.destroy', $board->id)}}" method='POST' class="contain_link_table">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Supprimer</button>
                    </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </table></div>
    <div class="link_page">Ajouter<a href="{{route('boards.create')}}">Nouveau Board</a></div>
    @endif
@endsection