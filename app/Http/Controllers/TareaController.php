<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index()
    {
        $entrada = Tarea::where('estado', 'entrada')->orderBy('orden', 'asc')->get();
        $proceso = Tarea::where('estado', 'proceso')->orderBy('orden', 'asc')->get();
        $completada = Tarea::where('estado', 'completada')->orderBy('orden', 'asc')->get();

        return view('tareas.index', compact('entrada', 'proceso', 'completada'));
    }


    public function update(Request $request, $id)
    {
        $tarea = Tarea::find($id);
        $tarea->estado = $request->input('estado');
        $tarea->orden = $request->input('orden');
        $tarea->save();
    }



}
