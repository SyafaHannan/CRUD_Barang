<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class LoginController extends Controller
{
    //
    public function index()
    {
        //tampilkan halaman login
        $data = ['title' => 'Halaman Login Aplikasi Barang'];
        return view('login', $data);
    }


    public function check(Request $request)
    {
        $postData = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required']
            ]);

        if (Auth::attempt($postData)) :
            //jika login berhasil generate session dan redirect ke  halaman dashboard
            // $request->session()->regenerate();
            // if (Auth::user()->level == 'admin') :
                 return response(
                     [
                         'success' => true,
                         'redirect_url' => 'barang',
                         'pesan' => 'Login Berhasil'
                     ],200
                 );
            // elseif (Auth::user()->level == 'barang') :

            // elseif (Auth::user()->level == 'jual') :

            // elseif (Auth::user()->level == 'beli') :
                alert('jalan');


            // else :
            //     return response(
            //         [
            //             'success'=>false,
            //         ]
            //         );

            // endif;
        else :
            // alert('gagal');
            return response([
                'success' => false,
                'redirect_url' => 'hannan',
                'pesan' => 'login gagal'

            ]);

        endif;
    }
}
