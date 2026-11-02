<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\ProdukModel;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $detailModel;
    protected $produkModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel    = new TransaksiDetailModel();
        $this->produkModel    = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Riwayat Transaksi',
            'transaksi' => $this->transaksiModel->orderBy('id', 'DESC')->paginate(10),
            'pager'     => $this->transaksiModel->pager,
        ];
        return view('transaksi/index', $data);
    }

    public function create()
    {
        $data = [
            'title'  => 'Input Transaksi Pembelian',
            'produk' => $this->produkModel->orderBy('id', 'ASC')->findAll(),
        ];
        return view('transaksi/create', $data);
    }

    public function store()
    {
        $namaPelanggan = $this->request->getPost('nama_pelanggan');
        $metodeBayar   = $this->request->getPost('pembayaran');
        $produkIds     = $this->request->getPost('produk_id');
        $qtys          = $this->request->getPost('qty');

        if (empty($namaPelanggan) || empty($metodeBayar) || empty($produkIds)) {
            return redirect()->back()->withInput()->with('error', 'Semua data wajib diisi, minimal 1 produk.');
        }

        $totalBayar = 0;
        $items = [];

        foreach ($produkIds as $i => $produkId) {
            if (empty($produkId) || empty($qtys[$i])) continue;

            $produk = $this->produkModel->find($produkId);
            if (!$produk) continue;

            $qty      = (int) $qtys[$i];
            $subtotal = $produk['harga'] * $qty;
            $totalBayar += $subtotal;

            $items[] = [
                'produk_id'    => $produk['id'],
                'nama_produk'  => $produk['nama_produk'],
                'harga_satuan' => $produk['harga'],
                'qty'          => $qty,
                'subtotal'     => $subtotal,
            ];

            // Kurangi stok produk
            $this->produkModel->update($produk['id'], [
                'stok' => max(0, $produk['stok'] - $qty),
            ]);
        }

        if (empty($items)) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada produk valid yang dipilih.');
        }

        $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad(($this->transaksiModel->countAll() + 1), 4, '0', STR_PAD_LEFT);

        $transaksiId = $this->transaksiModel->insert([
            'no_transaksi'      => $noTransaksi,
            'nama_pelanggan'    => $namaPelanggan,
            'pembayaran'        => $metodeBayar,
            'total_bayar'       => $totalBayar,
        ]);

        foreach ($items as $item) {
            $item['transaksi_id'] = $transaksiId;
            $this->detailModel->insert($item);
        }

        return redirect()->to('/transaksi')->with('success', "Transaksi $noTransaksi berhasil disimpan.");
    }

    public function show($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'title'     => 'Detail Transaksi',
            'transaksi' => $transaksi,
            'items'     => $this->detailModel->where('transaksi_id', $id)->findAll(),
        ];
        return view('transaksi/show', $data);
    }
}
