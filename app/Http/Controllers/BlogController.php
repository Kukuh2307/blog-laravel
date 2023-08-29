<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slide;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index')->with([
            'tittle'    => 'Beranda',
            'slides'    => Slide::all(),
            'jumlah'    => Slide::count()
        ]);
    }
}
