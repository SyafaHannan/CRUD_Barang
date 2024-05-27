<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared('
            CREATE TRIGGER TrJualBarang after insert on jual 
                for each row
                    begin
                        update stok set jumlah = jumlah - new.jumlah_jual where id_barang = new.id_barang;
                        end
                        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('drop trigger TrJualBarang');
    }
};
