<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import slugable
use Cviebrock\EloquentSluggable\Sluggable;

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
}
