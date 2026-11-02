<?php

namespace App\Models;

use CodeIgniter\Model;

class StokMasukModel extends Model
{
    protected $table         = 'stok_masuk';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['no_referensi', 'produk_id', 'nama_produk', 'jumlah', 'keterangan'];
    protected $returnType    = 'array';
}
