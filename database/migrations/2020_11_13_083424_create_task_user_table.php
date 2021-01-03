<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration CreateTasksTable qui permet de créer la table pivot des tâches et des utilisateurs
 * 
 * @author Thomas Payan <thomas.payan@ynov.com>
 * 
 */
class CreateTaskUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->foreignId("task_id")->constrained()->onDelete('cascade');
            $table->unique(["user_id", "task_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_user');
    }
}
