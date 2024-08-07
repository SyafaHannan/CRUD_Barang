<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    //
    protected $id_barang;
    protected $nama_barang;
    protected $kode_barang;
    protected $harga;
    protected $barangModel;

    public function __construct()
    {
        //function khusus dari laravel
        $this->barangModel = new Barang();
    }
    
    public function index()
    {
        // $data = [
        //     'barangList' => $this->barangModel::all()
        // ];
        /**
         * tampilkan $data ke dalam view
         * file barang/list.blade.php
         */
        return view('barang.index');
    }

    public function tambah()
    {
        /**
         * method ini akan menampilkan form html
         * untuk  input data barang
         * data form akan dikirim ke controller simpan
         */
        return view('barang.tambah');
    }

    public function simpan1(Request $request)
    {
        /**
         * method ini akan menyimpan data yang dikirim dari method tambah
         */
        $data = $request->validate([
            'nama_barang' => ['required'],
            'kode_barang' => ['required'],
            'harga' => ['required']
        ]);

        if(isset($request->id_barang)):
            $update = Barang::where('id_barang','=',$request->id_barang)->update($data);
        if($update){
            return redirect()->route('barang.index');
        }else{
            return redirect()->route('barang.tambah');
        }
        else:
            $insert = Barang::create($data);
            if($insert){
                return redirect()->route('barang.index');
            }else{
                return redirect()->route('barang.tambah');
            }
        endif;
    }
    public function edit(Request $request){
        /**
         * method ini hanya bisa diakses dengan http method get
         */
        $data = [
            'barangDetil' => Barang::where('id_barang',$request->id_barang)->first()
        ];
        return view('barang.edit',$data);
    }
    public function update(StoreBarangRequest $request)
    {
        $data =  $request->validated();
        $perintah = Barang::where('id_barang',$request->id_barang)->update($data);
        $pesan = [
            'status' => 'success',
            'pesan'  => 'Data Barang berhasil di perbarui'
        ];
        return($pesan);

    }
    public function simpan(StoreBarangRequest $request)
    {
        $data =  $request->validated();
                //proses penambahan data baru
                $dataBaru = Barang::create($data);
                if($dataBaru):
                    $pesan = [
                        'status' => 'success',
                        'pesan'  => 'Data Barang Baru berhasil ditambahkan ke dalam database'
                    ];
                else:
                    $pesan = [
                        'status' => 'error',
                        'pesan'  => 'Data Barang Baru gagal ditambahkan'
                    ];
                endif;
            return response()->json($pesan);

    }

    public function hapus(Request $request)
    {
        /**
         * method ini hanya bisa diakses dengan http method post
         */
        $aksiHapus = Barang::where('id_barang',$request->id_barang)->delete();
        if($aksiHapus):
            $pesan = [
            'status' => 'success',
            'pesan'  => 'Data Berhasil Di Hapus'
            ];
        else:
            $pesan = [
                'status' => 'error',
                'pesan'  => 'Data Gagal Di Hapus'
            ];
        endif;    
        return response()->json($pesan);
        
    }
    public function dataBarang(Request $request){
        if($request->ajax()):
            $data = $this->barangModel->with('stok')->get();
            return DataTables::of($data)->toJson();
        endif;
    }
    public function listBarang(Request $request)
    {
        if($request->filled('term')):
            $data = Barang::select(['nama_barang','id_barang'])
                    ->where('nama_barang','LIKE','%'.$request->get('q').'%')->get();
            return response()->json($data);
        endif;
    }
}
