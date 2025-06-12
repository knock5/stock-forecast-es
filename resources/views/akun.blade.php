@extends('template.appuser')
@section('content')
<div class="row">
    <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
            <h3 class="card-title text-center fw-semibold mb-4"> Data Akun User</h3>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah User</button>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover table-bordered border-primary">
                    <thead>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <!-- <th>Satuan</th> -->
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($users as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $g->name }}</td>
                            <td>{{ $g->email }}</td>
                            <!-- <td>{{ $g->SATUAN }}</td> -->
                            <td>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $g->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        <div class="modal fade" id="hapus{{ $g->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="{{url('akun/hapus/'.$g->id)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus Akun</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <p>Apakah anda ingin menghapus akun dengan username : <strong>{{ $g->name }}</strong> ini ?</p>
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
                            <form action="{{url('akun/tambah')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="" >
                                        <label for="floatingInput">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                        <input type="text" name="password" class="form-control" id="floatingInput" placeholder="name@example.com" >
                                        <label for="floatingInput">Password</label>
                                        </div>
                                        </div>

                                    </div>    
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">SImpan</button>
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