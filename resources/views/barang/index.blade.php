@extends('template/template')

@section('title','CRUD Penjualan')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <btn class="btn btn-success  btnTambahBarang" data-bs-target='#modalForm' data-bs-toggle="modal" attr-href="{{route('barang.tambah')}}"><i class='bi bi-plus-circle'></i> Tambah</btn>
        </div>
        <div class="card-body">
            <table class="table DataTable table-hovered table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <!-- <a href="{{url('/barang/tambah/')}}"><btn class="btn btn-success">Tambah Barang</btn></a> -->

        </div>
    </div>
    <!-- bagian modal -->
    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdroplabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-success btnSimpanBarang"><i class="bi bi-save"></i> Simpan</button> <button class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer')
<script type="module">
    const barangModal = document.querySelector('#modalForm');
    const modal = bootstrap.Modal.getOrCreateInstance(barangModal);
    var table = $('.DataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!!route('barang.data')!!}",
        columns: [{
                data: 'nama_barang',
                nama: 'nama_barang',
            },
            {
                data: 'kode_barang',
                nama: 'kode_barang'
            },
            {
                render: function(data, type, row) {
                    return row.stok.jumlah;
                }
            },
            {
                render: function(data, type, row) {
                    return "<btn class='btn btn-primary editBtn' data-bs-toggle='modal' data-bs-target='#modalForm' attr-href='{!!url('/barang/edit/" + row.id_barang + "')!!}'><i class='bi bi-pencil'></i> edit</btn> <btn class='btn btn-danger btnHapusBarang' attr-id='" + row.id_barang + "'><i class='bi bi-trash'></i> Hapus</btn>";

                }
            }
        ]

    });
    //hapus callback
    $('.DataTable tbody').on('click', '.btnHapusBarang', function(hapus) {
        let idBarang = $(this).closest('.btnHapusBarang').attr('attr-id');
        Swal.fire({
            title: "Apakah Anda Yakin Ingin Menghapus Data?",
            text: "NOTE : Data yang sudah di hapus tidak dapat dikembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus"
        }).then((result) => {
            if (result.isConfirmed) {
                let dataHapus = {
                    'id_barang': idBarang,
                    '_token': '{{csrf_token()}}'
                };
                axios.post('{{url("barang/hapus")}}', dataHapus).then(response => {
                    if (response.data.status == 'success') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.data.pesan,
                            icon: 'success'
                        }).then(() => {
                            table.ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.data.pesan,
                            icon: 'error'
                        });

                    }
                })
            }
        });
    })
    //edit callbcak
    $('.DataTable tbody').on('click', '.editBtn', function(event) {
        changeHTML('#modalForm', '.modal-title', 'Edit data barang');
        let modalForm = document.getElementById('modalForm');
        modalForm.addEventListener('shown.bs.modal', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            let link = event.relatedTarget.getAttribute('attr-href');
            axios.get(link).then(response => {
                $('#modalForm .modal-body').html(response.data);
                //$(".modal-header .modal-title").html("Edit");

            });
            //event edit simpan
            $('.btnSimpanBarang').on('click', function(editSimpanEvent) {
                editSimpanEvent.stopImmediatePropagation();
                var dataEdit = {
                    'id_barang': $('#idBarang').val(),
                    'kode_barang': $('#kodeBarang').val(),
                    'nama_barang': $('#namaBarang').val(),
                    'harga': $('#hargaBarang').val(),
                    '_token': "{{csrf_token()}}"
                };
                axios.post('{{url("/barang/simpan")}}', dataEdit).then(response => {
                    if (response.data.status == 'success') {
                        Swal.fire({
                            title: 'Berhasil Di Update',
                            text: response.data.pesan,
                            icon: 'success'
                        }).then(() => {
                            //close modal
                            modal.hide();
                            //reload table otomatis
                            table.ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Aaduhhh gagal...',
                            text: response.data.pesan,
                            icon: 'error'
                        });
                    }
                });
            });
        });

    });

    $('.btnTambahBarang').on('click', function(a) {
        a.preventDefault();
        changeHTML('#modalForm', '.modal-title', 'Tambah data barang');
        const modalForm = document.getElementById('modalForm');
        modalForm.addEventListener('shown.bs.modal', function(eventTambah) {
            eventTambah.preventDefault();
            eventTambah.stopImmediatePropagation();
            const link = event.relatedTarget.getAttribute('attr-href');
            const modalData = document.querySelector('#modalForm .modal-body');
            //$(".modal-header .modal-title").html("Tambah data barang baru");

            axios.get(link).then(response => {
                $('#modalForm .modal-body').html(response.data);
            });

            //event simpan barang ketika btn di klik
            $('.btnSimpanBarang').on('click', function(simpanEvent) {
                simpanEvent.preventDefault();
                simpanEvent.stopImmediatePropagation();
                let data = {
                    'kode_barang': $('#kodeBarang').val(),
                    'nama_barang': $('#namaBarang').val(),
                    'harga': $('#hargaBarang').val(),
                    '_token': "{{csrf_token()}}"

                };

                if (data.nama_barang !== '' && data.kode_barang !== '' && data.harga !== '') {
                    //Input data    
                    axios.post('{{url("/barang/simpan")}}', data).then(resp => {
                        if (resp.data.status == 'success') {
                            Swal.fire({
                                title: 'Berhasil',
                                text: resp.data.pesan,
                                icon: 'success'
                            }).then(() => {
                                //close modal
                                modal.hide();
                                //reload table otomatis
                                table.ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Oooppss data gagal ditambahkan',
                                text: resp.data.pesan,
                                icon: 'error'
                            });
                        }
                    });

                } else {
                    Swal.fire({
                        'title': 'Ooopps gagal',
                        'text': 'Form harus terisi semua',
                        'icon': 'error'
                    });
                }
            });

            // contoh menggunakan ajax
            // $.ajax({
            // url : link,
            // method : 'GET',
            // success : function(response){
            //     $('modalForm .modal-body').html(response)
            // }
        });
    });
    modalForm.addEventListener('hidden.bs.modal', function(closeEvent) {
        closeEvent.preventDefault();
        closeEvent.stopImmediatePropagation();

        $('#modalForm').removeData();
    })

    function changeHTML(element, find, text) {
        $(element).find(find).html();
        return $(element).find(find).html(text).promise().done();
    }
</script>
@endsection