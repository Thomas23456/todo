<?php

namespace App\Http\Controllers;

use App\Models\{Board, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Classe BoardController qui permet de gérer les vues des boards
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class BoardController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Cette fonction gre directement les autorisations pour chacune des méthodes du contrôleur 
         * en fonction des méthode du BoardPolicy (viewAny, view, update, create, ...)
         * 
         *  https://laravel.com/docs/8.x/authorization#authorizing-resource-controllers
         */
        $this->authorizeResource(Board::class, 'board');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //on récupérer tous les boards auxquels participe l'utilisateur connecté 
        $user = Auth::user();
        return view('user.boards.index', ['boards' =>  $user->boards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retourne le formulaire de création d'un board
        return view('user.boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //on vérifie les données du formulaire avant de créer le board
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
        ]);
        $board = new Board(); 
        $board->user_id = Auth::user()->id; 
        $board->title = $validatedData['title']; 
        $board->description = $validatedData['description']; 
        $board->save();

        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //ici on doit on doit maintenant fournir la liste des utilisateurs qui ne sont pas dans le board pour pouvoir les inviter
        //on récupère les ids des users du board : 
        $boardUsersId = $board->users->pluck('id'); 
        
        //on sélectionne maintenant tous les utilisateurs dont l'id n'appartient pas à la liste des ids des utilisateurs du board
        $usersNotInBoard = User::whereNotIn('id', $boardUsersId)->get(); 
        return view("user.boards.show", ['board' => $board, 'users' => $usersNotInBoard, 'owner' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //retourne la vue pour éditer le board
        return view('user.boards.edit', ['board' => $board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        //on vérifie les données du formulaire avant de mettre à jour le board
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
            'user_id' => 'required',
        ]);
        $board->title = $validatedData['title']; 
        $board->description = $validatedData['description']; 
        $board->user_id = $validatedData['user_id']; 
        $board->update();

        return redirect()->route('boards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        //on supprime le board
        $board->delete(); 
        return redirect()->route('boards.index');
    }
}
