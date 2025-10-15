<?= $this->include('templates_admin/header'); ?>
<?= $this->include('templates_admin/sidebar'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengajuan Pengembalian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">Pengajuan #<?= $return['id'] ?></h5>
                                    <p class="mb-1"><strong>ID Pesanan (DB):</strong> #<?= $return['order_id'] ?></p>
                                    <p class="mb-1"><strong>ID Pesanan Midtrans:</strong> <span class="text-primary"><?= esc($midtrans_order_id ?? '-') ?></span></p>
                                    <p class="mb-1"><strong>Pelanggan:</strong> <?= esc($user['fullname'] ?? $user['username'] ?? $user['email'] ?? $return['user_id']) ?></p>
                                    <p class="mb-1"><strong>Tanggal Pengajuan:</strong> <?= $return['created_at'] ?></p>
                                    <p class="mb-1"><strong>Status:</strong> 
                                        <form method="post" action="<?= base_url('admin/returns/update_status/' . $return['id']) ?>" class="d-inline">
                                            <select name="status" class="form-control d-inline w-auto">
                                                <option value="pending" <?= $return['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                <option value="approved" <?= $return['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                                <option value="rejected" <?= $return['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                <option value="completed" <?= $return['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </p>
                                    <p class="mb-1"><strong>Alasan:</strong> <?= esc($return['reason']) ?></p>
                                    <p class="mb-1"><strong>Opsi Pengembalian:</strong> 
                                        <?php if (!empty($return['return_type'])): ?>
                                            <span class="badge badge-<?= $return['return_type'] == 'refund' ? 'danger' : 'info' ?>">
                                                <?= $return['return_type'] == 'refund' ? 'Pengembalian Dana' : 'Penggantian Barang' ?>
                                            </span>
                                            <?php if ($return['return_type'] == 'refund' && in_array($return['status'], ['pending', 'approved'])): ?>
                                                <form method="post" action="<?= base_url('admin/returns/refund/' . $return['id']) ?>" class="mt-2">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Proses refund ke Midtrans?')">
                                                        <i class="fas fa-money-bill-wave"></i> Proses Refund
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted">Belum dipilih</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">Foto Bukti</h6>
                                    <?php if ($return['photo']): ?>
                                        <img src="<?= base_url('uploads/returns/' . $return['photo']) ?>" alt="Bukti" class="img-fluid rounded border" style="max-width:100%;max-height:250px;">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada foto</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Barang yang Diajukan Pengembalian</h5>
                            <?php if (!empty($items)): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Gambar</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $item): ?>
                                                <tr>
                                                    <td><?= esc($item->nama_produk) ?></td>
                                                    <td><img src="<?= base_url('assets/upload/' . $item->gambar) ?>" alt="Gambar" style="max-width:60px;max-height:60px;"></td>
                                                    <td><?= $item->quantity ?></td>
                                                    <td>Rp<?= number_format($item->price, 0, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada data barang.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?= base_url('admin/returns') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include('templates_admin/footer'); ?>
