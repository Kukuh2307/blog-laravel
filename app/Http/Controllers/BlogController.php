<?php

namespace App\Http\Controllers;

use App\Models\Articles;
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
            'articles'                 => Articles::orderBy('created_at','desc')->paginate(5)->withQueryString(),
            'categoriesTittle'         => 'Kategori',
        ]);
    }
    public function article(){
        $articles = Articles::latest();
        $filter = '';
        $filter_name = '';
        if(request('cari')){
            $articles->where('judul','like','%'. request('cari') . '%')
                    ->orWhere('isi','like','%' . request('cari') . '%');
            $filter = request('cari');
            $filter_name = 'hasil pencarian';
        }
        // filter dari aside berdasarkan kataegori
        if(request('kategori')){
            // mengambil slug di category
            $category = Category::firstWhere('slug',request('kategori'));
            // lalu di cocokkan dengan category id yang ada di tabel artikel
            $articles->where('category_id', $category->id);
            $filter = $category->nama;
            $filter_name = 'Kategori';
        }
        // filter dari tag berdasarkan slug
        if(request('tag')){
            // whereHas mengambil 2 argumen, 1 adalah relasi dan query
            $articles->whereHas('tags',function($query){
                $query->where('slug',request('tag'));
            });
            $filter = request('tag');
            $filter_name = 'Tag';
        }
        return view('blog.artikel')->with([
            'tittle'                   => 'Artikel',
            'categories'               => Category::all(),
            'articles'                 => $articles->paginate(5)->withQueryString(),
            'categoriesTittle'         => 'Kategori',
            'cari'                     => $filter,
            'hasil'                    => $filter_name,
            'test'                     => 'testing',
        ]);
    }
}
