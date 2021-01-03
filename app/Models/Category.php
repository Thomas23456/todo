<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

/**
 * Classe Category reliée aux tâches
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Renvoi la liste des tâches possédant cette catégorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
