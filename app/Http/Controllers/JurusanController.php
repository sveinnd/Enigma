<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
class JurusanController extends Controller
{
    public static function index(){
        return Jurusan::all();
    }

    public static function getJurusan($id_jurusan){
        $jrs = Jurusan::where('id_jurusan', $id_jurusan)->first();
        return $jrs->jurusan;
    }

    public function create(request $request){
        $qwe = new Jurusan;
        $qwe->id_jurusan = $request->id_jurusan;
        $qwe->jurusan = $request->jurusan;
        $qwe->save();

        return $qwe;
    }
    public function update(request $request, $id_jurusan){
        $id_jurusan = $request->id_jurusan;
        $jurusan = $request->jurusan;

        $qwe = Jurusan::where('id_jurusan',$id_jurusan)->first;
        $id_jurusan = $request->id_jurusan;
        $jurusan = $request->jurusan;
        $qwe->save();
        return $qwe;
    }

    public function delete($id_jurusan){
        $qwe = Jurusan::where('id_jurusan',$id_jurusan)->first;
        $qwe->delete();
        return $qwe;
    }
}
