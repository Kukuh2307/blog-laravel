<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class slideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.slide.index')->with([
            'slides'    => Slide::all(),
            'tittle'    => 'Slide',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.slide.slide-baru')->with(['tittle' => 'Slide']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul'     => 'required|max:50',
            'gambar'    => 'image|file|max:1024',
            'kutipan'   => 'required|max:255'
        ], [
            'judul.required'    => 'Headline harus di isi',
            'judul.max'         => 'Maksimal 50 karakter',
            'gambar.image'      => 'Format gambar salah',
            'gambar.max'        => 'Maksimal ukuran gambar 1 MB',
            'kutipan.required'  => 'Kutipan harus di isi',
            'kutipan.max'       => 'Maksimal 255 karakter'
        ]);

        if ($request->file('gambar')) {
            $namaGambar = $request->file('gambar')->hashName();
            $request->file('gambar')->move(public_path('images'), $namaGambar);
            $validasi['gambar'] = $namaGambar;
        }
        slide::create($validasi);
        return redirect('/dashboard/slide')->with('info', 'Slide baru berhasil di simpan');
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
        $slideEdit = Slide::where('id', $id)->first();
        return view('dashboard.slide.slide-edit')->with([
            'tittle'    => 'Edit Slide',
            'data'      => $slideEdit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'judul'     => 'required|max:50',
            'gambar'    => 'image|file|max:1024',
            'kutipan'   => 'required|max:255'
        ], [
            'judul.required'    => 'Headline harus di isi',
            'judul.max'         => 'Maksimal 50 karakter',
            'gambar.image'      => 'Format gambar salah',
            'gambar.max'        => 'Maksimal ukuran gambar 1 MB',
            'kutipan.required'  => 'Kutipan harus di isi',
            'kutipan.max'       => 'Maksimal 255 karakter'
        ]);

        // cek gambar yang di upload
        if ($request->file('gambar')) {
            // apabila gambar ada di database,maka akan di update,jika tidak ada maka akan di tambahkan
            if ($request->gambarLama) {
                File::delete(public_path('images/' . $request->gambarLama));
            }
            $namaGambar = $request->file('gambar')->hashName();
            $request->file('gambar')->move(public_path('images'), $namaGambar);
            $validasi['gambar'] = $namaGambar;
        }

        slide::where('id', $id)->update($validasi);
        return redirect('/dashboard/slide')->with('info', 'Slide berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ambil semua data sesuai id yang dikirim dari view slide
        $data = Slide::where('id', $id)->first();

        // kondisi jika gambarnya ada
        if ($data->gambar) {
            File::delete(public_path('images/') . $data->gambar);
        }
        Slide::where('id', $id)->delete();
        return back()->with('info', 'Slide berhasil di hapus');
    }
}
