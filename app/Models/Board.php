<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente un fichier attaché à un board par un utilisateur
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class Board extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($board) {
            $board_user = new BoardUser(); 
            $board_user->board_id = $board->id; 
            $board_user->user_id = $board->user_id; 
            $board_user->save();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ["title",'description','user_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boards';


    /**
     * Renvoie l'utilisateur propriétaire du board (celui qui l'a créé)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    } 


    /**
     * Renvoie tous les utilisateurs qui sont associés au board, c'est à dire les participants
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
                    ->using("App\Models\BoardUser")
                    ->withPivot("id")
                    ->withTimestamps();
    }

    /**
     * Renvoie toutes les tâches associées au board
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
