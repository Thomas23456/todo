<?php

namespace App\Policies;

use App\Models\{Task, User, Board};
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
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
    public function view(User $user, Board $board)
    {
        // La règle est qu'un utilisateur doit être participant du board pour voir le voir
        return $board                   // La board que l'utilisateur veut voir
                    ->users             // les utilisateurs qui participent à la board
                    ->find($user->id)   // On cherche dans les participants l'utilisateur qui effectue l'action (on aurait pu faire : ->where('id', '=', $user->id))
                    !== null;           // Si on obtient un résultat différent de null, c'est que l'on y a trouvé l'utilisateur
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // La règle est que les participants du board peuvent modifier la tâche
        return Auth::user()->id === $user->id; 
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        // La règle est qu'un utilisateur doit être participant du board pour pouvoir modifier la tâche
        return $task                          // La board que l'utilisateur veut voir
                    ->participants           // les utilisateurs qui participent à la board reliés à la tâche
                    ->find(Auth::user()->id)  // On cherche dans les participants l'utilisateur qui effectue l'action (on aurait pu faire : ->where('id', '=', $user->id))
                    !== null;                 // Si on obtient un résultat différent de null, c'est que l'on y a trouvé l'utilisateur
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     * @return mixed
     */
    public function delete(User $user, Board $board)
    {
        // La règle est que seul le propriétaire du board peut supprimer la tâche
        return $user->id ===  $board->user_id; //$board->owner->id;
    }

}
