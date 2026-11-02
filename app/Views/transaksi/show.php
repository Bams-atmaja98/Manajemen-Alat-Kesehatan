<?= view('templates/header') ?>

<div class="card card-stat p-4" id="invoiceArea" style="max-width:650px">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h5 class="fw-bold mb-0">ALKESIN</h5>
            <small class="text-muted">Alat Kesehatan Indonesia</small>
        </div>
        <span class="badge bg-success fs-6">LUNAS</span>
    </div>

    <table class="table table-borderless mb-3">
        <tr>
            <td class="text-muted" width="180">No. Transaksi</td>
            <td>: <?= esc($transaksi['no_transaksi']) ?></td>
        </tr>
        <tr>
            <td class="text-muted">Nama Pelanggan</td>
            <td>: <?= esc($transaksi['nama_pelanggan']) ?></td>
        </tr>
        <tr>
            <td class="text-muted">Metode Pembayaran</td>
            <td>: <?= esc($transaksi['pembayaran']) ?></td>
        </tr>
        <tr>
            <td class="text-muted">Tanggal</td>
            <td>: <?= date('d M Y H:i', strtotime($transaksi['created_at'])) ?></td>
        </tr>
    </table>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-end">Harga</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['nama_produk']) ?></td>
                    <td class="text-end">Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                    <td class="text-end"><?= $item['qty'] ?></td>
                    <td class="text-end">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end fw-bold">TOTAL BAYAR</td>
                <td class="text-end fw-bold">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-3">
        <a href="<?= base_url('transaksi') ?>" class="btn btn-outline-secondary">Kembali</a>
        <button onclick="window.print()" class="btn btn-alkesin text-white"><i class="bi bi-printer"></i> Cetak</button>
    </div>
</div>

<style>
    @media print {

        /* Sembunyikan semua elemen di luar invoice */
        .sidebar,
        .topbar,
        .btn,
        a.btn {
            display: none !important;
        }

        .main-content {
            margin-left: 0 !important;
        }

        .content-area {
            padding: 0 !important;
        }

        body {
            background: #fff !important;
        }

        #invoiceArea {
            box-shadow: none !important;
            border: none !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Sembunyikan elemen lain di luar invoice kalau ada */
        body * {
            visibility: hidden;
        }

        #invoiceArea,
        #invoiceArea * {
            visibility: visible;
        }

        #invoiceArea {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
    }
</style>

<?= view('templates/footer') ?>