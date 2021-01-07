<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Représente un fichier attaché à une tâche par un utilisateur
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['file',"filename",'size','type','user_id','task_id'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachments';


    /**
     * Renvoi l'utilisateur qui a posé la pièce jointe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Renvoi la tâche à laquelle la pièce jointe est attachée
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
