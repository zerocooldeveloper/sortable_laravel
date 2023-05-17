<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tareas = [
            ['Tarea 1', 'entrada', 1],
            ['Tarea 2', 'entrada', 2],
            ['Tarea 3', 'proceso', 1],
            ['Tarea 4', 'proceso', 2],
            ['Tarea 5', 'completada', 1],
            ['Tarea 6', 'completada', 2],
        ];

        foreach ($tareas as $tarea) {
            DB::table('tareas')->insert([
                'titulo' => $tarea[0],
                'estado' => $tarea[1],
                'orden' => $tarea[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
