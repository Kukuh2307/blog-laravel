<?php

namespace App\Models;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Model;

// import slugable
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            // slug di generate dari id,for nama pada view kategori baru
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    // relasi tabel kategori dengan tabel artikel yang dimana 1 kategori bisa memiliki banyak artikel (one to many)
    public function articles()
    {
        return $this->hasMany(Artikel::class);
    }
}
