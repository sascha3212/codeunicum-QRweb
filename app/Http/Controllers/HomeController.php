<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;


class HomeController extends Controller
{
    public function GenerateQR()
    {
        $randomhash = bin2hex(random_bytes(256));

        return view('qrcode',[
            'qrcode_hash' => $randomhash
        ]);

    }
}
