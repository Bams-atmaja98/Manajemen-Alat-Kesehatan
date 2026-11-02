<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $model;

    protected $kategoriList = [
        'Alat Bantu Mobilitas',
        'Alat Diagnostik',
        'Alat Pelindung Diri',
        'Alat Terapi Pernapasan',
        'P3K',
        'Peralatan Oksigen',
        'Perawatan Luka',
    ];

    public function __construct()
    {
        $this->model = new ProdukModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');
        $query = $this->model;

        if ($keyword) {
            $query = $query->groupStart()
                ->like('nama_produk', $keyword)
                ->orLike('kode_produk', $keyword)
                ->orLike('kategori', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'  => 'Data Produk',
            'produk' => $query->orderBy('id', 'DESC')->paginate(10),
            'pager'  => $this->model->pager,
            'keyword' => $keyword,
        ];

        return view('produk/index', $data);
    }

    public function create()
    {
        return view('produk/create', [
            'title'     => 'Tambah Produk',
            'kategori'  => $this->kategoriList,
        ]);
    }

    public function store()
    {
        if (!$this->validate($this->model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->save([
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = $this->model->find($id);
        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan.');
        }
        return view('produk/edit', [
            'title' => 'Edit Produk',
            'produk' => $produk,
            'kategori' => $this->kategoriList,
        ]);
    }

    public function update($id)
    {
        if (!$this->validate($this->model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
