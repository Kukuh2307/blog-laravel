<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // relasi artikel ke tabel user (one to one), 1 artikel hanya dibuat oleh 1 user dan 1 user bisa membuat banyak artikel (one to many)
    public function user()
    {
        // one to one antar tabel artikel dengan user
        return $this->belongsTo(User::class);
    }

    // relasi artikel ke tabel kategori (one to one), 1 artikel hanya memiliki 1 kategori dan 1 kategori bisa memiliki banyak artikel
    public function category()
    {
        // one to one antar tabel artikel dengan kategori
        return $this->belongsTo(Category::class);
    }

    // relasi artikel ke tabel tag (many to many) 1 artikel bisa memiliki banyak tag, dan 1 tag bisa memuat banyak artikel
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
