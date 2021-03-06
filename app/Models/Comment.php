<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Représente un commentaire rédigé sur une tâche par un utilisateur
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'user_id', 'task_id'];

    /**
     * Renvoi l'utilisateur qui a écrit le commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Renvoi la tâche à laquelle est associé le commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
