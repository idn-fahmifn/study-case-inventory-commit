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
                        {{ $data->name }}
                    </h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, voluptatum?</p>

                    {{-- tombol modals --}}
                    <button type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="#tambahData">
                        Tambah Data
                    </button>
                    {{-- modals --}}
                    <div class="modal fade" id="tambahData" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('petugas.update', $data->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $data->name }}" required placeholder="Fahmi Nuradi">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Nama Pengguna
                                                        (Username)</label>
                                                    <input type="text" class="form-control" name="username"
                                                        value="{{ $data->username }}" required placeholder="Ex. fahmi17">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Status Akun</label>
                                                    <select name="isActive" class="form-control">
                                                        <option value="{{ $data->isActive }}">
                                                            @if ($data->isActive)
                                                                Sudah Aktif
                                                            @else
                                                                Belum Aktif
                                                            @endif
                                                        </option>
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Non-Aktif</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Avatar</label>
                                                    <input type="file" id="input-file-now-custom-3" name="avatar"
                                                        class="dropify" data-height="300"
                                                        data-default-file="{{ asset('storage/images/avatar/'.$data->avatar) }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- alert --}}

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Sukeses!</strong> {{ session('success') }}.
                        </div>
                    @endif

                    {{-- pembungkus table --}}
                    <div class="table-responsive">
                        <table class="table table-hover"">
                            <tr>
                                <th colspan="2" class="text-center">
                                    <img src="{{ asset('storage/images/avatar/' . $data->avatar) }}" class="img-fluid"
                                        width="200px" alt="Avatar">
                                </th>
                            </tr>
                            <tr>
                                <th>Nama Lengkap </th>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th>Username </th>
                                <td>{{ $data->username }}</td>
                            </tr>
                            <tr>
                                <th>Status </th>
                                <td>
                                    @if ($data->isActive)
                                        <span class="text-success">Sudah Aktif</span>
                                    @else
                                        <span class="text-muted">Non-Katif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
