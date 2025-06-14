@extends('template.appuser')
@section('content')
@section('title', 'Halaman Data Keluar Barang')
@php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp
<div class="row">
    <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
            <h3 class="card-title text-center fw-semibold mb-4"> Data Keluar Barang</h3>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Barang Keluar</button>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover table-bordered border-primary">
                    <thead>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Keluar</th>
                        <th>Jumlah Keluar</th>
                        <th>Lokasi</th>
                        @if (Auth::user()->level == 'admin')
                        <th>Aksi</th>
                        @else
                        @endif
                    </thead>
                    <tbody>
                        @foreach($keluar as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $g->gudang->NAMA}}</td>
                            <td>{{ \Carbon\Carbon::parse($g->TANGGAL_KELUAR)->translatedFormat('d F Y, H:i') }}</td>
                            <td>{{ $g->JUMLAH_KELUAR }} {{$g->gudang->SATUAN}}</td>
                            <td>{{ $g->LOKASI ?? 'tidak ada' }}</td>
                            @if (Auth::user()->level == 'admin')
                            <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $g->ID_KELUAR}}"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $g->ID_KELUAR }}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            @else
                            @endif
                        </tr>

                        <div class="modal fade" id="edit{{ $g->ID_KELUAR}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('keluar/ubah/'.$g->ID_KELUAR)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Barang Keluar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-floating mb-3">   
                                        <select class="form-select" name="barang" id="floatingSelect" aria-label="Floating label select example">
                                        @foreach($gudang as $b)
                                            <option value="{{ $b->ID_BARANG }}" {{ ($b->ID_BARANG == $g->ID_BARANG) ? 'selected' : '' }}>
                                                {{ $b->NAMA }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <label for="floatingSelect">Pilih Barang Masuk</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="datetime-local" name="tanggal" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $g->TANGGAL_KELUAR }}">
                                        <label for="floatingInput">Tanggal</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="number" name="jumlah" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $g->JUMLAH_KELUAR }}">
                                        <label for="floatingInput">Jumlah Keluar</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="lokasi" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $g->LOKASI}}">
                                        <label for="floatingInput">Lokasi</label>
                                        </div>
                                        </div>

                                    </div>    
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>


                        
                        <div class="modal fade" id="hapus{{ $g->ID_KELUAR }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('masuk/hapus/'.$g->ID_KELUAR)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus Barang Masuk</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <p>Apakah anda ingin menghapus riwayat masuk barang pada tanggal <strong>{{ $g->TANGGAL_MASUK }}</strong> ini ?</p>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">Hapus</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                                                @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('keluar/tambah')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Barang Keluar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-floating mb-3">
                                        <select class="form-select" name="barang" id="floatingSelect" aria-label="Floating label select example">
                                            <option selected value="0">--- pilih barang ---</option>
                                            @foreach($gudang as $b)
                                            <option value="{{ $b->ID_BARANG }}">{{ $b->NAMA }}</option>
                                           @endforeach
                                           
                                        </select>
                                        <label for="floatingSelect">Pilih Barang Keluar</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="datetime-local" name="tanggal" class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">tanggal</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="number" name="jumlah"  class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Jumlah Keluar</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="lokasi"  class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Lokasi</label>
                                        </div>
                                        </div>

                                    </div>    
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

<script>
           $('#example').DataTable();
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
@endsection