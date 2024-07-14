<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
