<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Update Promo</h1>
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

                        <form action="<?= base_url('admin/promo/update') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $promo['id'] ?>">
                            
                            <div class="form-group">
                                <label>Produk</label>
                                <input type="text" class="form-control" value="<?= $item['nama_produk'] ?> - <?= isset($item['nama_type']) ? $item['nama_type'] : '' ?>" readonly>
                                <small class="text-muted">Harga Normal: Rp <?= number_format($item['harga'], 0, ',', '.') ?></small>
                            </div>

                            <div class="form-group">
                                <label>Persentase Diskon (%)</label>
                                <input type="number" name="discount_percentage" class="form-control" min="1" max="100" 
                                       value="<?= old('discount_percentage', $promo['discount_percentage']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Harga Setelah Diskon</label>
                                <input type="text" id="discounted_price" class="form-control" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="start_date" class="form-control" 
                                               value="<?= old('start_date', $promo['start_date']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="end_date" class="form-control" 
                                               value="<?= old('end_date', $promo['end_date']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?= $promo['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $promo['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
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
    const originalPrice = <?= $item['harga'] ?>;
    const discountInput = document.querySelector('input[name="discount_percentage"]');
    const discountedPriceDisplay = document.querySelector('#discounted_price');
    
    function calculateDiscountedPrice() {
        const discount = parseFloat(discountInput.value) || 0;
        const discountedPrice = originalPrice - (originalPrice * discount / 100);
        discountedPriceDisplay.value = 'Rp ' + discountedPrice.toLocaleString('id-ID');
    }

    discountInput.addEventListener('input', calculateDiscountedPrice);
    calculateDiscountedPrice(); // Calculate initial value

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
