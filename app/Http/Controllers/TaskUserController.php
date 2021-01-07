<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TaskUser, Task, Board};

/**
 * Classe TaskUserController qui permet de gérer les vues de la table pivots TaskUser
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class TaskUserController extends Controller
{

    /**
     * Store a newly created resource in storage for a given board (in uri param).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board rattaché à l'utilisateur
     * @param Task $task la tâche dans laquelle on souhaite ajouter un utilisateur
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board, Task $task)
    {
        //on vérifie les données du formulaire avant de créer le task_user
        $validatedData = $request->validate([
            'participant_id' => 'required|integer|exists:users,id'
        ]);
        $task_user = new TaskUser(); 
        $task_user->user_id = $validatedData['participant_id']; 
        $task_user->task_id = $task->id; 
        $task_user->save(); 

        return redirect()->route('tasks.show', [$board, $task]);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskUser  $taskUser l'instance à supprimer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskUser $taskUser)
    {
        //on supprime le task_user
        $taskUser->delete();
        $task = $taskUser->task;
        $board = $task->board;
        return redirect()->route('tasks.show', [$board, $task]);
    }
}
