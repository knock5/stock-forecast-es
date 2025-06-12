@extends('template.appuser')
@section('content')
@section('title', 'Halaman Form Prediksi')
<style>


.title {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 700;
  color: #111827;
}

.form {
  margin-top: 1.5rem;
}

.input-group {
  margin-top: 0.25rem;
  font-size: 0.875rem;
}

.input-group label {
  display: block;
  color: #4b5563;
  margin-bottom: 4px;
}

.input-group select {
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid #d1d5db;
  background-color: transparent;
  padding: 0.75rem 1rem;
  color: #111827;
}

.input-group select:focus {
  border-color: #a78bfa;
  outline: none;
}

.sign {
  display: block;
  width: 100%;
  background-color: #a78bfa;
  padding: 0.75rem;
  text-align: center;
  color: #ffffff;
  border: none;
  border-radius: 0.375rem;
  font-weight: 600;
  margin-top: 1rem;
}
.form-container {
  max-width: 100%;
  width: 100%;
  border-radius: 0.75rem;
  background-color: #ffffff;
  padding: 2rem;
  color: #111827;
  border: 1px solid #e5e7eb;
  box-sizing: border-box;
}

</style>


<div class="row">
  <div class="col-12 col-md-4 mx-auto">
    <div class="form-container">
      <p class="title">Form Prediksi</p>
      <form  class="form" method="POST" action="{{url('hasil')}}" enctype="multipart/form-data">
      @csrf
  <div class="input-group">
    <label for="kategori">Kategori Produk</label>
    <select name="kategori" id="kategori">
      <option value="0" disabled selected>Pilih Kategori</option>
    @foreach($gudang as $b)
    <option value="{{$b->ID_BARANG}}">{{$b->NAMA}}</option>
    @endforeach
    </select>
  </div>
  <button type="submit" class="sign">Prediksi</button>
</form>
    </div>
  </div>
</div>

@endsection
