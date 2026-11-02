<?= view('templates/header') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card card-stat p-4" style="max-width:650px">
    <form action="<?= base_url('stok-gudang/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3 position-relative produk-combobox">
            <label class="form-label">Pilih Produk</label>
            <input type="text" class="form-control produk-search" placeholder="-- Pilih Produk --" autocomplete="off" readonly>
            <input type="hidden" name="produk_id" class="produk-id-input" required>
            <div class="produk-dropdown-list d-none">
                <?php foreach ($produk as $p): ?>
                    <div class="produk-item" data-id="<?= $p['id'] ?>" data-nama="<?= esc($p['nama_produk']) ?>" data-stok="<?= $p['stok'] ?>">
                        <span><?= esc($p['nama_produk']) ?></span>
                        <span class="text-muted small">Stok saat ini: <?= $p['stok'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok Saat Ini</label>
            <input type="text" class="form-control" id="stokSaatIni" value="-" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Stok Masuk</label>
            <input type="number" name="jumlah" class="form-control" min="1" placeholder="Contoh: 20" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan (opsional)</label>
            <textarea name="keterangan" class="form-control" rows="2" placeholder="Misal: Restock dari supplier PT XYZ"></textarea>
        </div>

        <button type="submit" class="btn btn-alkesin text-white px-4">
            <i class="bi bi-box-arrow-in-down"></i> Simpan & Tambah Stok
        </button>
        <a href="<?= base_url('stok-gudang') ?>" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>

<style>
    .produk-combobox {
        position: relative;
    }

    .produk-dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        max-height: 220px;
        overflow-y: auto;
        z-index: 50;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        margin-top: 4px;
    }

    .produk-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 14px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .produk-item:hover {
        background: #ecfdf5;
    }

    .produk-search {
        cursor: pointer;
        background: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('.produk-search');
        const dropdownList = document.querySelector('.produk-dropdown-list');
        const idInput = document.querySelector('.produk-id-input');
        const stokSaatIni = document.getElementById('stokSaatIni');

        searchInput.addEventListener('click', (e) => {
            dropdownList.classList.toggle('d-none');
            e.stopPropagation();
        });

        dropdownList.querySelectorAll('.produk-item').forEach(item => {
            item.addEventListener('click', () => {
                searchInput.value = item.dataset.nama;
                idInput.value = item.dataset.id;
                stokSaatIni.value = item.dataset.stok + ' unit';
                dropdownList.classList.add('d-none');
            });
        });

        document.addEventListener('click', () => {
            dropdownList.classList.add('d-none');
        });
    });
</script>

<?= view('templates/footer') ?>