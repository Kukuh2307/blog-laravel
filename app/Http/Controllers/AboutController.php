<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function index(){
        $lang_url = public_path('admin/devicon.json');
        $lang_data = file_get_contents($lang_url);
        $lang_data = json_decode($lang_data,true);
        $lang = array_column($lang_data,'name');
        $lang = '"'. implode('","',$lang).'"';
        return view('dashboard.index')->with([
            'tittle'        => 'About',
            'source'        => $lang,
        ]);
    }

    public function update(Request $request){
        $validasi = $request->validate([
            'foto'          => 'image|file|max:1024',
            'name'          => 'required',
            'email'         => 'required|email',
            'telephone'     => 'required|numeric',
            'alamat'        => 'required',
            'keahlian'      => 'required',
            'words'         => 'required',
        ],[
            'foto.image'            => 'foto yang anda uplad bukan gambar',
            'foto.max'              => 'foto maksimal 1 MB',
            'name.required'         => 'Nama penulis harus ada',
            'email.required'        => 'Email penulis harus ada',
            'email.email'           => 'format email penulis harus valid',
            'telephone.required'    => 'Nomor telephone harus di isi',
            'telephone.numeric'     => 'Format nomor telephone harus angka',
            'alamat.required'       => 'Alamat harus ada',
            'keahlian.required'     => 'Keahlian harus ada',
            'words.required'        => 'Words harus ada',
        ]);

        if($request->file('foto')){
            if($request->fotoLama){
                File::delete(public_path('images/' . $request->gambarLama));
            }
            $nama_foto = $request->file('foto')->hashName();
            $request->file('foto')->move(public_path('images'),$nama_foto);

            $validasi['foto'] = $nama_foto;

        }
        User::where('id',auth()->user()->id)->update($validasi);

        return back()->with('info','Data Penulis berhasil di update');
    }
}
