@extends('layouts.template')

@section('page-title')
    Petugas
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Data Petugas
                    </h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, voluptatum?</p>

                    {{-- tombol modals --}}
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tambahData">
                        Tambah Data
                    </button>
                    {{-- modals --}}
                    <div class="modal fade" id="tambahData" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Petugas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="#" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="name" required
                                                        placeholder="Fahmi Nuradi">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Nama Pengguna (Username)</label>
                                                    <input type="text" class="form-control" name="username" required placeholder="Ex. fahmi17">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Password</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Status Akun</label>
                                                    <select name="isActive" class="form-control">
                                                        <option value="">-Pilih Status Akun-</option>
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Non-Aktif</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
    
            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Send message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- pembungkus table --}}
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable-buttons">
                            <thead>
                                <th>Nama Lengkap</th>
                                <th>Nama Pengguna (Username)</th>
                                <th>Status Aktif</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fulan</td>
                                    <td>fulan1</td>
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>Fulan</td>
                                    <td>fulan1</td>
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>Fulan</td>
                                    <td>fulan1</td>
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>Fulan</td>
                                    <td>fulan1</td>
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
