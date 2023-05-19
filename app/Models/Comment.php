<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['body','tarea_id'];
    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
}
