<?php

namespace App\Models;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // relasi artikel ke tabel tag (many to many) 1 artikel bisa memiliki banyak tag, dan 1 tag bisa memuat banyak artikel
    public function articles()
    {
        return $this->belongsToMany(Artikel::class);
    }
}
