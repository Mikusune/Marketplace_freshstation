<div class="main-content">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah Promo</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <?= session('errors')->listErrors() ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/promo/tambah_aksi') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="form-group">
                                <label>Pilih Produk</label>
                                <select name="id_item" class="form-control" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php foreach ($available_items as $item) : ?>
                                        <option value="<?= $item['id_item'] ?>" data-price="<?= $item['harga'] ?>">
                                            <?= $item['nama_produk'] ?> - <?= $item['nama_type'] ?> 
                                            (Rp <?= number_format($item['harga'], 0, ',', '.') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Persentase Diskon (%)</label>
                                <input type="number" name="discount_percentage" class="form-control" min="1" max="100" value="<?= old('discount_percentage') ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Harga Setelah Diskon</label>
                                <input type="text" id="discounted_price" class="form-control" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="start_date" class="form-control" value="<?= old('start_date') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="end_date" class="form-control" value="<?= old('end_date') ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?= base_url('admin/promo') ?>" class="btn btn-warning">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemSelect = document.querySelector('select[name="id_item"]');
    const discountInput = document.querySelector('input[name="discount_percentage"]');
    const discountedPriceDisplay = document.querySelector('#discounted_price');

    // Inisialisasi Select2 untuk search produk
    $(itemSelect).select2({
        placeholder: '-- Pilih Produk --',
        allowClear: true,
        width: '100%'
    });

    function calculateDiscountedPrice() {
        const selectedOption = itemSelect.options[itemSelect.selectedIndex];
        if (selectedOption.value) {
            const originalPrice = parseFloat(selectedOption.dataset.price);
            const discount = parseFloat(discountInput.value) || 0;
            const discountedPrice = originalPrice - (originalPrice * discount / 100);
            discountedPriceDisplay.value = 'Rp ' + discountedPrice.toLocaleString('id-ID');
        } else {
            discountedPriceDisplay.value = '';
        }
    }

    // Event Select2 agar harga diskon langsung muncul saat memilih produk
    $(itemSelect).on('select2:select select2:unselect change', function() {
        calculateDiscountedPrice();
    });
    discountInput.addEventListener('input', calculateDiscountedPrice);

    // Validate end date is after start date
    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

    endDateInput.addEventListener('change', function() {
        if (startDateInput.value && this.value < startDateInput.value) {
            alert('Tanggal selesai harus setelah tanggal mulai');
            this.value = '';
        }
    });
});
</script>
