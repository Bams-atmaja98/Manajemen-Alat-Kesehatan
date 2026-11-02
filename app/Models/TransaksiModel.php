<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['no_transaksi', 'nama_pelanggan', 'pembayaran', 'total_bayar'];
    protected $returnType    = 'array';
}
