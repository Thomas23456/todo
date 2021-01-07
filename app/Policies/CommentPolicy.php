<?php

namespace App\Policies;

use App\Models\{Task, User, Board, Comment};
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

/**
 * Policy CommentPolicy qui permet de gérer les actions sur les commentaires
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //La règle est que l'utilisateur connecté peut voir les modèles
        return Auth::user()->id == $user->id; 
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        // La règle est qu'un utilisateur doit être participant de la tâche pour voir les commentaires
        return Auth::user()->id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // La règle est qu'un utilisateur doit être participant de la tâche pour ajouter un commentaire
        return Auth::user()->id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        // La règle est que seul le propriétaire peut modifier le commentaire
        return Auth::user()->id === $comment->user_id;       
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        // La règle est que seul le propriétaire peut supprimer le commentaire
        return Auth::user()->id === $comment->user_id;  
    }

}
