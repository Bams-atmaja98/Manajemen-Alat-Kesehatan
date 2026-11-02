<?= view('templates/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card card-stat p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Riwayat Transaksi</h6>
        <a href="<?= base_url('transaksi/create') ?>" class="btn btn-alkesin text-white">
            <i class="bi bi-plus-lg"></i> Input Transaksi
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Pelanggan</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi.</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($transaksi as $t): ?>
                <tr>
                    <td><?= esc($t['no_transaksi']) ?></td>
                    <td><?= esc($t['nama_pelanggan']) ?></td>
                    <td><span class="badge bg-secondary"><?= esc($t['pembayaran']) ?></span></td>
                    <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.') ?></td>
                    <td><?= date('d M Y H:i', strtotime($t['created_at'])) ?></td>
                    <td class="text-end">
                        <a href="<?= base_url('transaksi/show/' . $t['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div><?= $pager->links() ?></div>
</div>

<?= view('templates/footer') ?>