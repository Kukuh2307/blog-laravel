<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
