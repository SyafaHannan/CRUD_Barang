<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;
    protected $table = 'jual';
    protected $primarykey = 'id_jual';
    protected $fillable = ['id_barang','tanggal_jual','harga_jual_satuan','jumlah_jual','total_harga_jual'];
}
