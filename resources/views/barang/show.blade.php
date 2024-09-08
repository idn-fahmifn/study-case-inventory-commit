@extends('layouts.template')

@section('page-title')
    Barang
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
                                <form action="{{ route('barang.update', $data->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Barang</label>
                                                    <input type="text" class="form-control" value="{{$data->nama_barang}}"
                                                        name="nama_barang" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Penyimpanan</label>
                                                    <select name="id_ruangan" class="form-control" required>
                                                        <option value="{{ $data->id_ruangan }}">
                                                            {{ $data->ruangan->nama_ruangan }}</option>
                                                        @foreach ($ruangan as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_ruangan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Kondisi</label>
                                                    <select name="kondisi" required class="form-control">
                                                        <option value="{{ $data->kondisi }}">-{{ $data->kondisi }}-</option>
                                                        <option value="baik">Baik</option>
                                                        <option value="rusak">Rusak</option>
                                                        <option value="sedang perbaikan">Sedang perbaikan</option>
                                                        <option value="tidak digunakan">Tidak Digunakan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Kode Barang</label>
                                                    <select name="kode_barang" class="form-control">
                                                        <option value="">-{{ $data->kode_barang }}-
                                                        </option>
                                                        <option value="EL">Elektronik (EL)</option>
                                                        <option value="AT">Alat Tulis (AT)</option>
                                                        <option value="AB">Alat Berat (AB)</option>
                                                        <option value="FT">Furniture (FT)</option>
                                                        <option value="LG">Logistik Umum (LG)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Kategori</label>
                                                    <select name="kategori" required class="form-control">
                                                        <option value="{{ $data->kategori }}">-{{ $data->kategori }}-
                                                        </option>
                                                        <option value="Elektronik">Elektronik (EL)</option>
                                                        <option value="Alat Tulis">Alat Tulis (AT)</option>
                                                        <option value="Alat Berat">Alat Berat (AB)</option>
                                                        <option value="Furniture">Furniture (FT)</option>
                                                        <option value="LG">Logistik Umum (LG)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Stok</label>
                                                    <input type="number" class="form-control" value="{{ $data->stok }}"
                                                        name="stok" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Satuan</label>
                                                    <select name="satuan" required class="form-control">
                                                        <option value="{{ $data->satuan }}">-{{ $data->satuan }}-</option>
                                                        <option value="Lembar">Lembar</option>
                                                        <option value="Unit">Unit</option>
                                                        <option value="Roll">Roll</option>
                                                        <option value="Liter">Liter</option>
                                                        <option value="Kilogram">Kilogram</option>
                                                        <option value="Gram">Gram</option>
                                                        <option value="Pack">Pack</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Gambar Barang</label>
                                                    <input type="file" value="{{ $data->gambar }}"
                                                        id="input-file-now-custom-3" name="gambar" class="dropify"
                                                        data-default-file="{{ asset('storage/images/barang/' . $data->gambar) }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Keterangan</label>
                                                    <textarea class="form-control summernote" name="keterangan">
                                                        {{ $data->keterangan }}
                                                    </textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger"
                                            data-dismiss="modal">Keluar</button>
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
                                <th>Kode Barang </th>
                                <td>{{ $data->kode_barang }}</td>
                                <td rowspan="3" class="text-center">
                                    {!! DNS2D::getBarcodeHTML('example.com', 'QRCODE') !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Barang </th>
                                <td>{{ $data->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi Penyimpanan </th>
                                <td>{{ $data->ruangan->nama_ruangan }}</td>
                            </tr>
                            <tr>
                                <th>Stok </th>
                                <td>{{ $data->stok }} {{ $data->satuan }}</td>
                                <td rowspan="4" class="text-center">
                                    <img src="{{ asset('storage/images/barang/' . $data->gambar) }}" class="img-fluid text-center"
                                        width="300px" alt="Ruangan">
                                </td>
                            </tr>
                            <tr>
                                <th>Kondisi </th>
                                <td>
                                    @if ($data->kondisi == 'baik')
                                        <span class="text-success">Barang dengan kondisi baik</span>
                                    @elseif($data->kondisi == 'rusak')
                                        <span class="text-danger">Barang Dalam kondisi Rusak</span>
                                    @elseif($data->kondisi == 'dalam perbaikan')
                                        <span class="text-warning">Barang Dalam Perbaikan</span>
                                    @else
                                        <span class="text-muted">Barang sudah tidak digunakan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Kategori </th>
                                <td>{{ $data->kategori }}</td>
                                
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td colspan="2">{!! $data->keterangan !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
