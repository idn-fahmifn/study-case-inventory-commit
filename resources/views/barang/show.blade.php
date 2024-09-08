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
                        Ubah Data
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

                                {{-- form nya --}}
                                <form action="{{ route('ruangan.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Ruangan</label>
                                                    <input type="text" class="form-control" value="{{$data->nama_ruangan}}" name="nama_ruangan" required
                                                        placeholder="Fahmi Nuradi">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Nama Penanggung Jawab</label>
                                                    <select name="id_user" class="form-control" required>
                                                        <option value="{{ $data->id_user }}">{{ $data->user->name }}
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
                                                    <input type="text" class="form-control" value="{{$data->kode_ruangan}}" name="kode_ruangan" placeholder="ex. C-101" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Ukuran</label>
                                                    <select name="ukuran" class="form-control" required>
                                                        <option value="{{$data->ukuran}}">
                                                            @if($data->ukuran == 'small')
                                                            Small (5m x 5m)
                                                            @elseif($data->ukuran == 'medium')
                                                            Medium (10m x 20m)
                                                            @else 
                                                            Large (Ruangan Besar)
                                                            @endif

                                                        </option>
                                                        <option value="small">Small (5m x 5m)</option>
                                                        <option value="medium">Medium (10m x 20m)</option>
                                                        <option value="Large">Large (Ruangan Besar)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Foto Ruangan</label>
                                                    <input type="file" id="input-file-now-custom-3" value="{{$data->foto_ruangan}}" name="foto_ruangan"
                                                        class="dropify" data-default-file="{{ asset('storage/images/ruangan/'.$data->foto_ruangan) }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Denah Ruangan</label>
                                                    <input type="file" id="input-file-now-custom-3" value="{{$data->denah_ruangan}}" name="denah_ruangan"
                                                        class="dropify" data-default-file="{{ asset('storage/images/denah/'.$data->denah_ruangan) }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Keterangan</label>
                                                    <textarea class="form-control summernote" name="keterangan">
                                                        {{$data->keterangan}}
                                                    </textarea>
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
                            {{-- <tr>
                                <th colspan="2" class="text-center">
                                    <img src="{{ asset('storage/images/ruangan/' . $data->foto_ruangan) }}"
                                        class="img-fluid" width="200px" alt="Avatar">
                                </th>
                            </tr> --}}
                            <tr>
                                <th>Kode Ruangan </th>
                                <td>{{ $data->kode_ruangan }}</td>
                                <td rowspan="2" class="text-center">
                                    <img src="{{ asset('storage/images/ruangan/' . $data->foto_ruangan) }}"
                                        class="img-fluid" width="150px" alt="Ruangan">
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Ruangan </th>
                                <td>{{ $data->nama_ruangan }}</td>
                            </tr>
                            <tr>
                                <th>Nama Penanggung Jawab </th>
                                <td>{{ $data->user->name }}</td>
                                <td rowspan="2" class="text-center">
                                    <img src="{{ asset('storage/images/denah/' . $data->denah_ruangan) }}"
                                        class="img-fluid" width="150px" alt="Ruangan">
                                </td>
                            </tr>
                            <tr>
                                <th>ukuran </th>
                                <td>
                                    @if ($data->ukuran == 'small')
                                        <span class="text-success">Ruangan Small</span>
                                    @elseif($data->ukuran == 'medium')
                                        <span class="text-info">Ruangan Medium</span>
                                    @else
                                        <span class="text-danger">Ruangan Large</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td colspan="2">{!!($data->keterangan)!!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
