@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Jurusan</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Tambah Data</button>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Http\Controllers\MahasiswaController::index() as $user)
                            <tr>
                                <th hidden class="getId">{{$user->id}}</th>
                                <td class="nama">{{$user->nama}}</td>
                                <td class="nim">{{$user->nim}}</td>
                                <td class="jurusan"> @php
                                    echo App\Http\Controllers\JurusanController::getJurusan($user->jurusan);
                                    @endphp
                                </td>
                                <td class="email">{{$user->email}}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#EditModal" class="btn btn-info" onclick="setText('{{$user->id}}', '{{$user->nama}}', '{{$user->nim}}', '{{$user->jurusan}}', '{{$user->email}}')">Edit</button>
                                    <button type="button" class="btn btn-danger hapus" onclick="hapus('{{$user->id}}')">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID Jurusan</th>
                                <th scope="col">Nama Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Http\Controllers\JurusanController::index() as $user)
                            <tr>
                                <th>{{$user->id_jurusan}}</th>
                                <td class="nama">{{$user->jurusan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-user-tambah">
                        <div class="form-group">
                            <label for="exampleInputNama1">Nama</label>
                            <input type="text" name="nama" class="form-control nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNim1">Nim</label>
                            <input type="number" name="nim" class="form-control nim">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlJurusan1">Jurusan</label>
                            <select name="jurusan" class="form-control jurusan">
                                @foreach(App\Http\Controllers\JurusanController::index() as $jrs)
                                <option value="{{$jrs->id_jurusan}}">{{$jrs->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" aria-describedby="emailHelp" class="form-control email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpan()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT-->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-user-edit">
                    <div class="form-group">
                            <input hidden type="text" name="id" class="form-control id">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputNama1">Nama</label>
                            <input type="text" name="nama" class="form-control nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNim1">Nim</label>
                            <input type="number" name="nim" class="form-control nim">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlJurusan1">Jurusan</label>
                            <select name="jurusan" class="form-control">
                                @foreach(App\Http\Controllers\JurusanController::index() as $jrs)
                                <option value="{{$jrs->id_jurusan}}">{{$jrs->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" aria-describedby="emailHelp" class="form-control email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="edit($('.id').val())">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection