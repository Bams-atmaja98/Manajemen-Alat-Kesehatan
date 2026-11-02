<?= view('templates/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card card-stat p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="get" class="d-flex gap-2">
            <input type="text" name="q" value="<?= esc($keyword) ?>" class="form-control" placeholder="Cari produk...">
            <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
        <a href="<?= base_url('produk/create') ?>" class="btn btn-alkesin text-white">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($produk)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data produk.</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($produk as $p): ?>
                <tr>
                    <td><?= esc($p['kode_produk']) ?></td>
                    <td><?= esc($p['nama_produk']) ?></td>
                    <td><span class="badge bg-info-subtle text-dark"><?= esc($p['kategori']) ?></span></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($p['stok'] <= 5): ?>
                            <span class="badge bg-danger"><?= $p['stok'] ?></span>
                        <?php else: ?>
                            <?= $p['stok'] ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="<?= base_url('produk/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="<?= base_url('produk/delete/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div><?= $pager->links() ?></div>
</div>

<?= view('templates/footer') ?>