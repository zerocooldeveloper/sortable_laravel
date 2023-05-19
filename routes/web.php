<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();
Route::get('/', [TareaController::class, 'index'])->name('tareas.index');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::get('/tareas/{task}/comentarios', [CommentController::class, 'index']);
Route::post('/tareas/{task}/comentarios', [CommentController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
