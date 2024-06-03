<div class="row">
    <div class="col-lg-12">
    <form method="POST" id="tambah" action="{{url('beli/simpan')}}">
        <div class="form-group">
            <label>Nama Barang</label>
            <input class="form-control autoDropdownBarang" name="id_barang" id="idBarang"/>
        </div>
        <div class="form-group">
            <label>Tanggal Pembelian</label>
            <input class="form-control" type="date" name="tanggal_beli" id="tanggalBeli"/>
        </div>
        <div class="form-group">
            <label>Jumlah Pembelian</label>
            <input class="form-control" type="number" name="jumlah_beli" id="jumlahBeli"/>
        </div>
        <div class="form-group">
            <label>Harga Barang</label>
            <input class="form-control" type="number" name="harga_beli_satuan" id="hargaBeliSatuan"/>
        </div>
    </div>
    @csrf
</div>