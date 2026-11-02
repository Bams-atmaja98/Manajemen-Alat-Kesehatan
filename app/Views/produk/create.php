<?= view('templates/header') ?>

<div class="card card-stat p-4" style="max-width:700px">
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('produk/store') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" value="<?= old('kode_produk') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?= old('nama_produk') ?>" required>
        </div>
        <div class="mb-3 position-relative kategori-combobox">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control kategori-search" placeholder="-- Pilih Kategori --" autocomplete="off" readonly value="<?= old('kategori') ?>">
            <input type="hidden" name="kategori" class="kategori-input" value="<?= old('kategori') ?>" required>
            <div class="kategori-dropdown-list d-none">
                <?php foreach ($kategori as $k): ?>
                    <div class="kategori-item" data-value="<?= esc($k) ?>"><?= esc($k) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="<?= old('harga') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= old('stok') ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= old('deskripsi') ?></textarea>
        </div>
        <button type="submit" class="btn btn-alkesin text-white">Simpan</button>
        <a href="<?= base_url('produk') ?>" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>

<style>
    .kategori-combobox {
        position: relative;
    }

    .kategori-dropdown-list {
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

    .kategori-item {
        padding: 8px 14px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .kategori-item:hover {
        background: #ecfdf5;
    }

    .kategori-search {
        cursor: pointer;
        background: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('.kategori-search');
        const dropdownList = document.querySelector('.kategori-dropdown-list');
        const hiddenInput = document.querySelector('.kategori-input');

        searchInput.addEventListener('click', (e) => {
            dropdownList.classList.toggle('d-none');
            e.stopPropagation();
        });

        dropdownList.querySelectorAll('.kategori-item').forEach(item => {
            item.addEventListener('click', () => {
                searchInput.value = item.dataset.value;
                hiddenInput.value = item.dataset.value;
                dropdownList.classList.add('d-none');
            });
        });

        document.addEventListener('click', () => {
            dropdownList.classList.add('d-none');
        });
    });
</script>

<?= view('templates/footer') ?>