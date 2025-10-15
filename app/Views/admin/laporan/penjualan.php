
<?= $this->include('templates_admin/header'); ?>
<?= $this->include('templates_admin/sidebar'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Penjualan</h1>
        </div>
        <div class="section-body">
            <div class="card mb-4">
                <div class="card-header">
                    <form class="form-inline" method="get">
                        <div class="form-group mr-2">
                            <label for="tanggal_mulai" class="mr-2">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= esc($tanggal_mulai) ?>">
                        </div>
                        <div class="form-group mr-2">
                            <label for="tanggal_akhir" class="mr-2">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= esc($tanggal_akhir) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Penjualan</h5>
                                    <p class="card-text fs-4">Rp<?= number_format($total_penjualan, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Modal</h5>
                                    <p class="card-text fs-4">Rp<?= number_format($total_modal, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Keuntungan Bersih</h5>
                                    <p class="card-text fs-4">Rp<?= number_format($total_keuntungan, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <th>Subtotal Penjualan</th>
                                    <th>Subtotal Modal</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan as $row): ?>
                                <tr>
                                    <td><?= esc($row['created_at']) ?></td>
                                    <td><?= esc($row['nama_produk']) ?></td>
                                    <td><?= esc($row['quantity']) ?></td>
                                    <td>Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['harga_beli'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['subtotal_penjualan'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['subtotal_modal'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['keuntungan'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($laporan)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data penjualan pada rentang tanggal ini.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include('templates_admin/footer'); ?>
