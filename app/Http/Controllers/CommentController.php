<?php

namespace App\Http\Controllers;

use App\Models\{Comment,Task, Board};
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board, Task $task)
    {
        return view('comments.index', ['board' => $board, 'task' => $task]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Task $task le task à partir duquel on crée le commentaire
     * @return \Illuminate\Http\Response
     */
    public function create(Board $board, Task $task)
    {
        return view('comments.create', ['board' => $board, 'task' => $task]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Task $task le task à partir duquel on crée le commentaire
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board, Task $task)
    {
        $validatedData = $request->validate([
            'text' => 'required|string|max:255',
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout. 
        $validatedData['board_id'] = $board->id;
        $validatedData['task_id'] = $task->id;
        Comment::create($validatedData); 
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
        //
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
        //
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
        //
        $validatedData = $request->validate([
            'text' => 'required|string|max:255',
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout. 
        
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
        $comment->delete(); 
        return redirect()->route('comments.index', [$board, $task]);
    }
}
