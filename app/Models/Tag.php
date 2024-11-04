<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Связь «многие ко многим» с заметками
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}
