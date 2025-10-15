<?= $this->include('templates_admin/header'); ?>
<?= $this->include('templates_admin/sidebar'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pengajuan Pengembalian</h1>
        </div>
        <div class="section-body">
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success"> <?= session()->getFlashdata('pesan') ?> </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Pesanan</th>
                                <th>User</th>
                                <th>Alasan</th>
                                <th>Status</th>
                                <th>Opsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($returns as $r): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><?= esc($r['midtrans_order_id']) ?></td>
                                <td><?= esc($r['fullname'] ?? $r['username'] ?? $r['user_id']) ?></td>
                                <td><?= esc($r['reason']) ?></td>
                                <td><span class="badge badge-<?= $r['status'] == 'pending' ? 'warning' : ($r['status'] == 'approved' ? 'success' : ($r['status'] == 'rejected' ? 'danger' : 'info')) ?>"><?= ucfirst($r['status']) ?></span></td>
                                <td><?= $r['created_at'] ?></td>
                                <td>
                                    <?php if (!empty($r['return_type'])): ?>
                                        <span class="badge badge-<?= $r['return_type'] == 'refund' ? 'danger' : 'info' ?>">
                                            <?= $r['return_type'] == 'refund' ? 'Pengembalian Dana' : 'Penggantian Barang' ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">Belum dipilih</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/returns/detail/' . $r['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include('templates_admin/footer'); ?>
