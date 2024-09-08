@extends('layouts.template')

@section('page-title')
    Ruangan
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Data Ruangan
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
                                    <h5 class="modal-title">Tambah Ruangan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('ruangan.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Ruangan</label>
                                                    <input type="text" class="form-control" name="nama_ruangan" required
                                                        placeholder="Fahmi Nuradi">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Nama Penanggung Jawab</label>
                                                    <select name="id_user" class="form-control" required>
                                                        @foreach ($petugas as $item)
                                                            @if (!$item->isAdmin && $item->isActive)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Kode Ruangan</label>
                                                    <input type="text" class="form-control" name="kode_ruangan" placeholder="ex. C-101" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Ukuran</label>
                                                    <select name="ukuran" class="form-control" required>
                                                        <option value="">-Pilih Status Akun-</option>
                                                        <option value="small">Small (5m x 5m)</option>
                                                        <option value="medium">Medium (10m x 20m)</option>
                                                        <option value="Large">Large (Ruangan Besar)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Foto Ruangan</label>
                                                    <input type="file" id="input-file-now-custom-3" name="foto_ruangan"
                                                        class="dropify" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Denah Ruangan</label>
                                                    <input type="file" id="input-file-now-custom-3" name="denah_ruangan"
                                                        class="dropify" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Keterangan</label>
                                                    <textarea class="form-control summernote" name="keterangan"></textarea>
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
                        <table class="table table-hover" id="datatable-buttons">
                            <thead>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Penanggung Jawab</th>
                                <th>Pilihan</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    @if (!$item->isAdmin)
                                    @endif
                                    <tr>
                                        <td>{{ $item->kode_ruangan }}</td>
                                        <td>{{ $item->nama_ruangan }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <div class="btn-group mo-mb-2">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Pilihan</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('ruangan.show', $item->id) }}">Detail</a>
                                                    {{-- <a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('formDelete').submit()" href="#">Hapus</a> --}}
                                                    <form action="{{ route('ruangan.destroy', $item->id) }}"
                                                        id="formDelete" method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn dropdown-item"
                                                            onclick="return confirm('Apakah data akan dihapus?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
