<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public static function index(){
        return Mahasiswa::all();
    }

    public function create(request $request){
        $mhs = new Mahasiswa;
        $mhs->nama = $request->nama;
        $mhs->nim = $request->nim;
        $mhs->jurusan = $request->jurusan;
        $mhs->email = $request->email;
        $mhs->save();

        return $mhs;
    }

    public function update(request $request, $id){
        $nama = $request->nama;
        $nim = $request->nim;
        $jurusan = $request->jurusan;
        $email = $request->email;

        $mhs = Mahasiswa::find($id);
        $mhs->nama = $nama;
        $mhs->nim = $nim;
        $mhs->jurusan = $jurusan;
        $mhs->email = $email;
        $mhs->save();

        return $mhs;
    }

    public function delete($id){
        $mhs = Mahasiswa::find($id);
        $mhs->delete();

        return $mhs;
    }
}
