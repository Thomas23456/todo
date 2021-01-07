<?php

namespace App\Http\Controllers;

use App\Models\{Category,Task, Board,TaskUser, User, BoardUser};
use Database\Factories\CategoryFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Classe TaskController qui permet de gérer les vues de la table des tâches
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        //retourne la page des tâches
        return view('tasks.index', ['board' => $board]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Board $board le board à partir duquel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function create(Board $board)
    {
        //retourne le formulaire de création des tâches
        $categories = Category::all(); 
        return view('tasks.create', ['categories' => $categories, 'board' => $board]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Board $board le board pour lequel on crée la tâche
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board)
    {
        //on vérifie les données du formulaire avant de créer la tâche
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id',
            'state'=>'required|in:todo,ongoing,done',
        ]);

        $task= new Task();
        $task->title = $validatedData["title"];
        $task->description = $validatedData["description"];
        $task->due_date = $validatedData["due_date"];
        $task->category_id = $validatedData["category_id"];
        $task->state = $validatedData["state"];
        $task->board_id = $board->id;
        $task->save();

        return redirect()->route('tasks.index', [$board]);
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board, Task $task)
    {
        //retourne le détail de la tâche
        return view('tasks.show', ['board' => $board, 'task' => $task, 'owner' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board, Task $task)
    {
        //retourne le formulaire pour modifier la tâche
        return view('tasks.edit', ['board' => $board, 'task' => $task, 'categories' => Category::all(), 'user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board, Task $task)
    {
        //on vérifie les données du formulaire avant de mettre à jour la tâche
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id', 
            'state' => 'in:todo,ongoing,done'
        ]);
        
        $task->update($validatedData); 
        return redirect()->route('tasks.index', [$board]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board, Task $task)
    {
        //on supprime la tâche
        $task->delete(); 
        return redirect()->route('tasks.index', [$board]);
    }
}
