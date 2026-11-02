<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();
        $data = [
            'title'             => 'Dashboard',
            'total_produk'      => $model->countAll(),
            'total_stok'        => array_sum(array_column($model->findAll(), 'stok')),
            'produk_terbaru'    => $model->orderBy('created_at', 'DESC')->findAll(5),
        ];
        return view('home', $data);
    }
}
