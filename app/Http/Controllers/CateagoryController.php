<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CateagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kategori.index')->with([
            'tittle'        => 'Kategori',
            'kategories'    => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kategori.kategori-baru')->with([
            'tittle'    => "Kategori"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama'      => 'required',
            'slug'      => 'required|unique:categories',
            'deskripsi' => 'max:255'
        ], [
            'nama.required'     => 'nama kategori harus di isi',
            'slug.unique'       => 'slug sudah ada',
            'deskripsi.max'     => 'maksimal 255 karakter',
        ]);
        Category::create($validasi);
        return redirect('/dashboard/kategori')->with('info', 'kategori baru berhasil di simpan');
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
        $kategoriEdit = Category::where('id', $id)->first();
        return view('dashboard/kategori/kategori-edit')->with([
            'tittle'    => 'Edit Kategori',
            'data'      => $kategoriEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Category::where('id', $id)->first();
        // cek apakah data dari view tidak sama dengan data yang ada di database
        if ($request->nama != $data->nama) {
            $validasi['nama'] = 'required';
            $validasi['slug'] = 'required|unique:categories';
        }
        $validasi['deskripsi'] = 'max:255';
        $dataValidasi = $request->validate($validasi, [
            'nama.required'     => 'nama kategori harus di isi',
            'slug.unique'       => 'slug sudah ada',
            'deskripsi.max'     => 'maksimal 255 karakter',
        ]);
        Category::where('id', $id)->update($dataValidasi);
        return redirect('/dashboard/kategori')->with('info', 'Kategori berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return back()->with('info', 'Kategori berhasil di hapus');
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->kategori);
        return response()->json(['slug' => $slug]);
    }
}
