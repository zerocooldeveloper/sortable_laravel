<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Obtiene los comentarios de una tarea
    public function index(Tarea $task)
    {
        // Devuelve los comentarios de la tarea en formato JSON
        return response()->json($task->comments);
    }

    // Crea un nuevo comentario para una tarea
    public function store(Request $request, Tarea $task)
    {
        // Valida el request
        $data = $request->validate([
            'body' => 'required'
        ]);

        // Crea un nuevo comentario
        $comment = new Comment($data);
        $comment->tarea_id = $task->id;

        // Guarda el comentario
        $comment->save();

        // Devuelve una respuesta de éxito
        return response()->json(['success' => true]);
    }
}

