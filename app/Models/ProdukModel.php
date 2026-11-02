<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table         = 'produk';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['kode_produk', 'nama_produk', 'kategori', 'harga', 'stok', 'deskripsi'];
    protected $useTimestamps = true;
    protected $returnType    = 'array';

    protected $validationRules = [
        'kode_produk' => 'required|min_length[3]|max_length[20]',
        'nama_produk' => 'required|min_length[3]|max_length[150]',
        'kategori'    => 'required',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
    ];
}
