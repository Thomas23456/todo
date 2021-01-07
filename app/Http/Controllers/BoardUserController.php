<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{BoardUser, Board};

/**
 * Classe BoardUserController qui permet de gérer les vues de la table pivot BoardUser
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class BoardUserController extends Controller
{

    /**
     * Store a newly created resource in storage for a given board (in uri param).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board dans lequel on souhaite ajouter un utilisateur
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board)
    {
        //on vérifie les données du formulaire avant de créer le user_board
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $board_user = new BoardUser(); 
        $board_user->user_id = $validatedData['user_id']; 
        $board_user->board_id = $board->id; 
        $board_user->save(); 

        return redirect()->route('boards.show', $board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoardUser  $boardUser l'instance à supprimer
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoardUser $boardUser)
    {
        //on supprime le user_board
        $boardUser->delete();
        $board = $boardUser->board;
        return redirect()->route('boards.show', $board);
    }
}
