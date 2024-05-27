<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $akuns = [
            [
                'username'=> 'barang',
                'password'=> Hash::make(123456),
                'level' => 'barang'
            ],

            [
                'username'=> 'jual',
                'password'=> Hash::make(123456),
                'level' => 'jual'
            ],

            [
                'username'=> 'beli',
                'password'=> Hash::make(123456),
                'level' => 'beli'
            ],

            [
                'username'=> 'admin',
                'password'=> Hash::make(123456),
                'level' => 'admin'
            ]
            ];
    }
}
