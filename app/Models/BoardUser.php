<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Classe pivot qui met en relation les boards et les utilisateurs
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class BoardUser extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @see https://laravel.com/docs/8.x/eloquent-relationships#defining-custom-intermediate-table-models
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['user_id','board_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board_user';


    /**
     * Renvoi l'utilisateur lié au board
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Renvoi le board lié à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }


    /**
     * Permet de récupérer toutes les tâches de la board. 
     * Servira de lien pour récupérer les tâches d'un utilisateur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tasks() {
        return $this->hasManyThrough(Task::class, Board::class, 'id', 'board_id', 'board_id');
    }
}
