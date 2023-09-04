<?php

namespace App\Http\Controllers;

use id;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.artikel.index')->with([
            'tittle'        => 'Artikel',
            'articles'      => Articles::orderBy('created_at', 'desc')->get(),
            'source'        => '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.artikel.artikel-baru')->with([
            'tittle'        => 'Artikel',
            'categories'    => Category::all(),
            'source'        => '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul'         => 'required|max:255',
            'slug'          => 'required|unique:articles',
            'gambar'        => 'image|file|max:1024',
            'category_id'   => 'required',
            'tag'           => 'required',
            'isi'           => 'required',
        ], [
            'judul.required'        => 'Judul artikel tidak boleh kosong',
            'judul.max'             => 'Maksimal 255 karakter',
            'slug.required'         => 'Slug tidak boleh kosong',
            'slug.unique'           => 'Slug sudah di pakai',
            'gambar.image'          => 'File yang anda upload bukan gambar',

            'gambar.max'            => 'Maksimal ukuran gambar 1 MB',
            'category_id.required'  => 'Kategori artikel harus dipilih',
            'tag.required'          => 'Tag artikel harus di isi',
            'isi.required'          => 'Isi artikel harus di isi',
        ]);

        // jika ada gambar yang di upload
        if ($request->file('gambar')) {
            $nama_gambar = $request->file('gambar')->hashName();
            // upload ke folder
            $request->file('gambar')->move(public_path('images'), $nama_gambar);
            $validasi['gambar'] = $nama_gambar;
        }
        // mengambil user id
        $validasi['user_id'] = auth()->user()->id;
        // mengambil kutipan dari isi dengan limit tertentu
        $validasi['kutipan'] = Str::limit(strip_tags($request->isi), 150);

        // input data ke tabel artikel
        $artikel = Articles::create($validasi);

        // input data ke tabel tag
        $tags = explode(',', $request->tag);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name'  => trim($tagName)]);
            // relasi tabel artikel dengan tabel tag yang dimana tags() berasal dari model artikel
            $artikel->tags()->attach($tag);
        };

        return redirect('/dashboard/artikel')->with('info', 'Artikel baru berhasi di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Articles::where('id', $id)->first();
        return view('dashboard.artikel.artikel-edit')->with([
            'tittle'        => 'Edit Artikel',
            'article'       => $article,
            'categories'    => Category::all(),
            'tags'          => $article->tags()->implode('name', ','),
            'source'        => '',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ambil artikel dari model dengan where
        $article = Articles::where('id', $id)->first();

        // cek validasi apakah sesuai
        $validasi = [
            'judul'         => 'required|max:255',
            'gambar'        => 'image|file|max:1024',
            'category_id'   => 'required',
            'tag'           => 'required',
            'isi'           => 'required',
        ];

        // jika slug dari input tidak sama dengan slug yng ada di tabel artikel maka lakuka validasi
        if ($request->slug != $article->slug) {
            $validasi['slug'] = 'required|unique:articles';
        }
        $dataValidasi = $request->validate($validasi, [
            'judul.required'        => 'Judul artikel tidak boleh kosong',
            'judul.max'             => 'Maksimal 255 karakter',
            'slug.required'         => 'Slug tidak boleh kosong',
            'slug.unique'           => 'Slug sudah di pakai',
            'gambar.image'          => 'File yang anda upload bukan gambar',

            'gambar.max'            => 'Maksimal ukuran gambar 1 MB',
            'category_id.required'  => 'Kategori artikel harus dipilih',
            'tag.required'          => 'Tag artikel harus di isi',
            'isi.required'          => 'Isi artikel harus di isi',
        ]);

        // apabila admin mengupload gambar
        if ($request->file('gambar')) {
            // apabila artikel memiliki gambar lama maka file gambar pada folder akan di hapus 
            if ($request->gambarLama) {
                File::delete(public_path('images/' . $request->gambarLama));
            }
            // setelah itu inputan gambar akan di hash dan di masukkan ke dalam folder path
            $nama_gambar = $request->file('gambar')->hashName();
            $request->file('gambar')->move(public_path('images'), $nama_gambar);

            // cek validasi gambar
            $dataValidasi['gambar'] = $nama_gambar;
        }

        // cek validasi user id
        $dataValidasi['user_id'] = auth()->user()->id;

        // cek validasi kutipan berdasarkan inputan isi yang di limit hanya 150 karakter
        $dataValidasi['kutipan'] = Str::limit(strip_tags($request->isi), 150);

        // proses update
        $article->update($dataValidasi);

        // pada bagian tag akan di pisah dan di buatkan variabel array kosong
        $tags = explode(',', $request->tag);
        $newTags = [];

        // dan akan dilakukan looping untuk memasukkan data
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            array_push($newTags, $tag->id);
        }
        $article->tags()->sync($newTags);

        // redirect dengan pesan
        return redirect('/dashboard/artikel')->with('info', 'artikel berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Articles::where('id', $id)->first();
        // apabila gambar tersimpan di folder maka akan di hapus
        if ($article->gambar) {
            File::delete(public_path('images') . '/' . $article->gambar);
        }
        // hapus tag dengan relasi tabel terkait
        $article->tags()->detach();

        Articles::where('id', $id)->delete();
        return back()->with('info', 'Artikel berhasil di hapus');
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(Articles::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
