<div class="row">
    <div class="col-lg-12">
    <form method="POST" id="tambah" action="{{url('barang/simpan')}}">
        <div class="form-group">
            <label>Nama Barang</label>
            <input class="form-control" type="text" name="nama_barang" id="namaBarang"/>
        </div>
        <div class="form-group">
            <label>Kode Barang</label>
            <input class="form-control" type="text" name="kode_barang" id="kodeBarang"/>
        </div>
        <div class="form-group">
            <label>Harga Barang</label>
            <input class="form-control" type="text" name="harga" id="hargaBarang"/>
        </div>
    </div>
    @csrf
</div>