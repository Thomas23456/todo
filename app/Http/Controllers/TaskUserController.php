<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\{TaskUser, Task};

class TaskUserController extends Controller
{
    //

    /**
     * Store a newly created resource in storage for a given board (in uri param).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board dans lequel on souhaite ajouter un utilisateur
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board, Task $task){
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $board_user = new TaskUser(); 
        $board_user->user_id = $validatedData['user_id']; 
        $board_user->board_id = $board->id; 
        $board_user->save(); 
        return redirect()->route('boards.show', $board);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskUser  $boardUser l'instance à supprimer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskUser $taskUser)
    {
        //TODO : correct bug
        //$board = $boardUser->board;
        $board = 60; 
        //BoardUser::where('id', $boardUser->pivot->id)->delete();
        //$boardUser->detach();
        //$boardDelete = BoardUser::find($boardUser);
        //$boardDelete->delete();
        //$boardUser->delete(); 
        return redirect()->route('boards.show', $board);
    }

}
