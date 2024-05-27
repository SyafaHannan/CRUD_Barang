<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beli extends Model
{
    use HasFactory;
    protected $table = 'beli';
    protected $primarykey = 'id_beli';
    protected $fillable = ['id_barang','tanggal_beli','harga_beli_satuan','jumlah_beli','total_harga_beli'];

    public function barang(): BelongsTo{
        return $this->belongsTo(Barang::class,'id_barang','id_barang','inner');
    }
}
