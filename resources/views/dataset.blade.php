@extends('template.appuser')
@section('content')
<div class="row">
    <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
            <h3 class="card-title text-center fw-semibold mb-4"> Data Stok Barang</h3>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Barang</button>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover table-bordered border-primary">
                    <thead>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($gudang as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $g->NAMA }}</td>
                            <td>{{ $g->JUMLAH ?? 0 }}</td>
                            <td>{{ $g->SATUAN }}</td>
                            <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $g->ID_BARANG }}"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $g->ID_BARANG }}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>

                        <div class="modal fade" id="edit{{ $g->ID_BARANG }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('dataset/ubah/'.$g->ID_BARANG)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $g->NAMA }}">
                                        <label for="floatingInput">Nama Barang</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="satuan" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $g->SATUAN }}">
                                        <label for="floatingInput">Satuan</label>
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


                        
                        <div class="modal fade" id="hapus{{ $g->ID_BARANG }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('dataset/ubah/'.$g->ID_BARANG)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <p>Apakah anda ingin menghapus barang <strong>{{ $g->NAMA }}</strong> ini ?</p>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
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
                            <form action="{{url('dataset/tambah')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Nama Barang</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="satuan" class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Satuan</label>
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