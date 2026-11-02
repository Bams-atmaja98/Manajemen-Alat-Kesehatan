<?= view('templates/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card card-stat p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Riwayat Stok Masuk</h6>
        <a href="<?= base_url('stok-gudang/create') ?>" class="btn btn-alkesin text-white">
            <i class="bi bi-plus-lg"></i> Tambah Stok
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>No. Referensi</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($stok)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat stok masuk.</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($stok as $s): ?>
                <tr>
                    <td><?= esc($s['no_referensi']) ?></td>
                    <td><?= esc($s['nama_produk']) ?></td>
                    <td><span class="badge bg-success">+<?= $s['jumlah'] ?></span></td>
                    <td><?= esc($s['keterangan'] ?: '-') ?></td>
                    <td><?= date('d M Y H:i', strtotime($s['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div><?= $pager->links() ?></div>
</div>

<?= view('templates/footer') ?>