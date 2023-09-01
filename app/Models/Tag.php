<?php

namespace App\Models;

use App\Models\Articles;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            // slug di generate dari id,for nama pada view artikel baru
            'slug' => [
                // diambil dari colom name di database
                'source' => 'name'
            ]
        ];
    }

    // relasi artikel ke tabel tag (many to many) 1 artikel bisa memiliki banyak tag, dan 1 tag bisa memuat banyak artikel
    public function articles()
    {
        return $this->belongsToMany(Articles::class);
    }
}
