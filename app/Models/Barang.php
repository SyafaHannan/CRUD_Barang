<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; //nama tabel
    protected $primarykey = 'id_barang'; //primary key pada tabel
    protected $fillable = ['nama_barang','kode_barang','harga'];//kolom pada tabel yang bisa diisi
    public $timestamps = false; 

    public function stok():HasOne
    {
        return $this->hasOne(Stok::class,'id_barang','id_barang');
    }
    public function beli():HasMany{
        return $this->hasMany(Beli::class,'id_barang','id_barang');
    }
}
