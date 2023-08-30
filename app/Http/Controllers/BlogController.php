<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\slide;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index')->with([
            'tittle'                   => 'Beranda',
            'slides'                   => Slide::all(),
            'jumlah-slides'            => Slide::count(),
            'categories'               => Category::all(),
            'categoriesTittle'        => 'Kategori',
        ]);
    }
}
