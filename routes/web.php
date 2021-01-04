<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Models\Board;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route pour la racine de l'appli
Route::get('/', function () {
    return view('welcome');
});

//route pour accéder au dashboard une fois authentifié
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/boards', [BoardController::class, 'index'])->middleware('auth')->name('boards.index');
// Route::get('/boards/create', [BoardController::class, 'create'])->middleware('auth')->name('boards.create');
// Route::get('/boards/{board}', [BoardController::class, 'show'])->middleware('auth')->name('boards.show');
// Route::post('/boards', [BoardController::class, 'store'])->middleware('auth')->name('boards.store');
// Route::get('/boards/{board}/edit', [BoardController::class, 'edit'])->middleware('auth')->name('boards.edit');
// Route::put('/boards/{board}', [BoardController::class, 'update'])->middleware('auth')->name('boards.update');
// Route::delete('/boards/{board}', [BoardController::class, 'destroy'])->middleware('auth')->name('boards.destroy');

// Route::get('boards/{board}/tasks/create', [TaskController::class, 'createFromBoard'])->middleware('auth')->name('boards.tasks.create');
// Route::post('boards/{board}/tasks', [TaskController::class, 'storeFromBoard'])->middleware('auth')->name('boards.tasks.store');

//routes pour les boards, tâches et commentaires
Route::resource('boards', BoardController::class)->middleware('auth');
Route::resource('boards/{board}/tasks', TaskController::class)->middleware('auth');
Route::resource('boards/{board}/tasks/{task}/comments', CommentController::class)->middleware('auth');

//routes pour les boarduser
Route::post('boards/{board}/boarduser', [BoardUserController::class ,  'store'])->middleware('auth')->name('boards.boarduser.store');
Route::delete('boarduser/{BoardUser}', [BoardUserController::class ,  'destroy'])->middleware('auth')->name('boards.boarduser.destroy');

//routes pour les taskuser
Route::post('boards/{board}/tasks/{task}/taskuser', [TaskUserController::class ,  'store'])->middleware('auth')->name('tasks.taskuser.store');
Route::delete('taskuser/{TaskUser}', [TaskUserController::class ,  'destroy'])->middleware('auth')->name('tasks.taskuser.destroy');