<h2>Konfigurasi Ongkir Toko</h2>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('admin/shipping/update') ?>">
    <div class="mb-3">
        <label for="price_per_km" class="form-label">Harga Ongkir per Kilometer (Rp)</label>
        <input type="number" class="form-control" id="price_per_km" name="price_per_km" value="<?= esc($config['price_per_km'] ?? 5000) ?>" required min="0">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
