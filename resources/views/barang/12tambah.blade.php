@extends('template/template')

@section('title','Tambah Barang')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <br>
        <div class="card">
          <form method="POST" id="tambah" action="{{url('barang/simpan')}}">

            <div class="card-header">
                <h3>Tambah Barang</h3>
            </div>
                    <div class="card-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control"/>
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control"/>
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control"/>

                        @csrf
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus-circle"></i> Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

