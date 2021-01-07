<?php

namespace App\Http\Controllers;

use App\Models\{Comment,Task, Board};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Classe CommentController qui permet de gérer les vues de la table des commentaires
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board, Task $task)
    {
        //retourne la page des commentaires
        return view('comments.index', ['board' => $board, 'task' => $task]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Board $board le board à partir duquel on créer la tâche
     * @param Task $task le task à partir duquel on crée le commentaire
     * @return \Illuminate\Http\Response
     */
    public function create(Board $board, Task $task)
    {
        //retourne le formulaire de création des commentaires
        return view('comments.create', ['board' => $board, 'task' => $task]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board à partir duquel on créer la tâche
     * @param Task $task le task à partir duquel on crée le commentaire
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board, Task $task)
    {
        //on vérifie les données du formulaire avant de créer le commentaire
        $validatedData = $request->validate([
            'text' => 'required|string|max:255',
        ]);
        $comment = new Comment(); 
        $comment->user_id = Auth::user()->id; 
        $comment->task_id = $task->id;
        $comment->text = $validatedData['text']; 
        $comment->save();

        return redirect()->route('comments.index', [$board, $task]);
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board, Task $task, Comment $comment)
    {
        //retourne le détail du commentaire
        return view('comments.show', ['board' => $board, 'task' => $task, 'comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board, Task $task, Comment $comment)
    {
        //retourne le formulaire pour modifier le commentaire
        return view('comments.edit', ['board' => $board, 'task' => $task, 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board, Task $task, Comment $comment)
    {
        //on vérifie les données du formulaire avant de mettre à jour le commentaire
        $validatedData = $request->validate([
            'text' => 'required|string|max:255',
        ]);
        
        $comment->update($validatedData); 
        return redirect()->route('comments.index', [$board, $task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board, Task $task, Comment $comment)
    {
        //on supprime le commentaire
        $comment->delete(); 
        return redirect()->route('comments.index', [$board, $task]);
    }
}
