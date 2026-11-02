<?= view('templates/header') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card card-stat p-4">
    <form action="<?= base_url('transaksi/store') ?>" method="post" id="formTransaksi">
        <?= csrf_field() ?>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Ketik nama pelanggan" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Metode Pembayaran</label>
                <div class="d-flex gap-2 flex-wrap">
                    <?php
                    $metode = [
                        'Tunai'    => 'bi-cash-stack',
                        'Transfer' => 'bi-bank',
                        'Debit'    => 'bi-credit-card',
                        'Kredit'   => 'bi-credit-card-2-front',
                        'QRIS'     => 'bi-qr-code',
                    ];
                    foreach ($metode as $key => $icon):
                    ?>
                        <label class="metode-option">
                            <input type="radio" name="pembayaran" value="<?= $key ?>"
                                <?= (old('pembayaran', 'Tunai') == $key) ? 'checked' : '' ?> required>
                            <span><i class="bi <?= $icon ?>"></i> <?= $key ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <h6 class="fw-semibold mb-3">Daftar Produk</h6>
        <div id="itemContainer">
            <div class="row g-2 mb-2 item-row">
                <div class="col-md-5">
                    <select name="produk_id[]" class="form-select produk-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p): ?>
                            <option value="<?= $p['id'] ?>" data-harga="<?= $p['harga'] ?>" data-stok="<?= $p['stok'] ?>">
                                <?= esc($p['kode_produk']) ?> &nbsp; | &nbsp; <?= esc($p['nama_produk']) ?> (Stok: <?= $p['stok'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="qty[]" class="form-control qty-input" placeholder="Qty" min="1" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100 btn-remove-row"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>

        <button type="button" id="btnAddRow" class="btn btn-outline-secondary btn-sm mb-4">
            <i class="bi bi-plus"></i> Tambah Produk
        </button>

        <div class="d-flex justify-content-end mb-4">
            <div class="text-end">
                <div class="text-muted">Total Bayar</div>
                <h3 class="fw-bold" id="totalBayarDisplay">Rp 0</h3>
            </div>
        </div>

        <button type="submit" class="btn btn-alkesin text-white px-4">
            <i class="bi bi-check-circle"></i> Simpan & Lunas
        </button>
        <a href="<?= base_url('transaksi') ?>" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>

<style>
    .metode-option input {
        display: none;
    }

    .metode-option span {
        display: flex;
        align-items: center;
        gap: 6px;
        border: 1.5px solid #dee2e6;
        border-radius: 8px;
        padding: 8px 14px;
        cursor: pointer;
        font-size: 0.9rem;
        color: #555;
    }

    .metode-option input:checked+span {
        border-color: #0d9488;
        background: #ecfdf5;
        color: #0d9488;
        font-weight: 600;
    }
</style>

<script>
    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function hitungSubtotal(row) {
        const select = row.querySelector('.produk-select');
        const qtyInput = row.querySelector('.qty-input');
        const subtotalDisplay = row.querySelector('.subtotal-display');

        const selectedOption = select.options[select.selectedIndex];
        const harga = parseFloat(selectedOption.dataset.harga) || 0;
        const stok = parseInt(selectedOption.dataset.stok) || 0;
        const qty = parseInt(qtyInput.value) || 0;

        if (qty > stok) {
            alert('Qty melebihi stok tersedia (' + stok + ')');
            qtyInput.value = stok;
        }

        const subtotal = harga * (parseInt(qtyInput.value) || 0);
        subtotalDisplay.value = formatRupiah(subtotal);
        subtotalDisplay.dataset.value = subtotal;

        hitungTotal();
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-display').forEach(el => {
            total += parseFloat(el.dataset.value) || 0;
        });
        document.getElementById('totalBayarDisplay').innerText = formatRupiah(total);
    }

    function bindRowEvents(row) {
        row.querySelector('.produk-select').addEventListener('change', () => hitungSubtotal(row));
        row.querySelector('.qty-input').addEventListener('input', () => hitungSubtotal(row));
        row.querySelector('.btn-remove-row').addEventListener('click', () => {
            if (document.querySelectorAll('.item-row').length > 1) {
                row.remove();
                hitungTotal();
            }
        });
    }

    document.querySelectorAll('.item-row').forEach(bindRowEvents);

    document.getElementById('btnAddRow').addEventListener('click', () => {
        const container = document.getElementById('itemContainer');
        const newRow = container.querySelector('.item-row').cloneNode(true);
        newRow.querySelectorAll('input, select').forEach(el => {
            if (el.tagName === 'SELECT') el.selectedIndex = 0;
            else el.value = '';
        });
        container.appendChild(newRow);
        bindRowEvents(newRow);
    });
</script>

<?= view('templates/footer') ?>