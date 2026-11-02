<?= view('templates/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-stat p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Total Produk</div>
                    <h3 class="fw-bold mb-0"><?= $total_produk ?></h3>
                </div>
                <div class="fs-1 text-teal" style="color:#0d9488"><i class="bi bi-box-seam"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Total Stok</div>
                    <h3 class="fw-bold mb-0"><?= $total_stok ?></h3>
                </div>
                <div class="fs-1" style="color:#1e40af"><i class="bi bi-boxes"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Selamat Datang</div>
                    <h5 class="fw-bold mb-0"><?= esc(session()->get('full_name')) ?></h5>
                </div>
                <div class="fs-1" style="color:#5eead4"><i class="bi bi-person-check"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card card-stat p-4">
    <h6 class="fw-semibold mb-3">Produk Terbaru</h6>
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk_terbaru as $p): ?>
                <tr>
                    <td><?= esc($p['kode_produk']) ?></td>
                    <td><?= esc($p['nama_produk']) ?></td>
                    <td><span class="badge bg-info-subtle text-dark"><?= esc($p['kategori']) ?></span></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td><?= esc($p['stok']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('templates/footer') ?>