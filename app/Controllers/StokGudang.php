<?php

namespace App\Controllers;

use App\Models\StokMasukModel;
use App\Models\ProdukModel;

class StokGudang extends BaseController
{
    protected $stokModel;
    protected $produkModel;

    public function __construct()
    {
        $this->stokModel   = new StokMasukModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Riwayat Stok Masuk',
            'stok'  => $this->stokModel->orderBy('id', 'DESC')->paginate(10),
            'pager' => $this->stokModel->pager,
        ];
        return view('stok_gudang/index', $data);
    }

    public function create()
    {
        $data = [
            'title'  => 'Tambah Stok Produk',
            'produk' => $this->produkModel->orderBy('nama_produk', 'ASC')->findAll(),
        ];
        return view('stok_gudang/create', $data);
    }

    public function store()
    {
        $produkId   = $this->request->getPost('produk_id');
        $jumlah     = (int) $this->request->getPost('jumlah');
        $keterangan = $this->request->getPost('keterangan');

        if (empty($produkId) || $jumlah <= 0) {
            return redirect()->back()->withInput()->with('error', 'Pilih produk dan isi jumlah stok dengan benar.');
        }

        $produk = $this->produkModel->find($produkId);
        if (!$produk) {
            return redirect()->back()->withInput()->with('error', 'Produk tidak ditemukan.');
        }

        $noReferensi = 'STK-' . date('Ymd') . '-' . str_pad(($this->stokModel->countAll() + 1), 4, '0', STR_PAD_LEFT);

        // Simpan riwayat stok masuk
        $this->stokModel->insert([
            'no_referensi' => $noReferensi,
            'produk_id'    => $produk['id'],
            'nama_produk'  => $produk['nama_produk'],
            'jumlah'       => $jumlah,
            'keterangan'   => $keterangan,
        ]);

        // Tambahkan ke stok produk
        $this->produkModel->update($produk['id'], [
            'stok' => $produk['stok'] + $jumlah,
        ]);

        return redirect()->to('/stok-gudang')->with('success', "Stok produk \"{$produk['nama_produk']}\" berhasil ditambah sebanyak $jumlah.");
    }
}
