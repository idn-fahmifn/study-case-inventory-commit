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
                        Data Barang
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
                                    <h5 class="modal-title">Tambah Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama_barang" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Penyimpanan</label>
                                                    <select name="id_ruangan" class="form-control" required>
                                                        @foreach ($ruangan as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Kondisi</label>
                                                    <select name="kondisi" required class="form-control">
                                                        <option value="">-Pilih Opsi-</option>
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
                                                    <select name="kode_barang" required class="form-control">
                                                        <option value="">-Pilih Opsi-</option>
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
                                                        <option value="">-Pilih Opsi-</option>
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
                                                    <input type="number" class="form-control" name="stok" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Satuan</label>
                                                    <select name="satuan" required class="form-control">
                                                        <option value="">-Pilih Opsi-</option>
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
                                                    <input type="file" id="input-file-now-custom-3" name="gambar"
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
