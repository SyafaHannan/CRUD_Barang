<?php

namespace App\Http\Controllers;

use App\Models\Beli;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BeliController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Beli::with('barang')->get();
            return DataTables::of($data)->toJson();
        }
        return view('beli.index');
    }
    public function tambah()
    {
        return view('beli.tambah');
    }
    public function simpan(Request $request)
    {
        $data = [
            'barangDetil' => Beli::where('id_barang',$request->id_barang)->first()
        ];
        $dataBaru = Beli::create($data);
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
    }
    public function laporan()
    {
        
    }
}
