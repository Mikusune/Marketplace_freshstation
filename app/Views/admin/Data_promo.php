<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Promo</h1>
        </div>
<!-- Modal konfirmasi hapus promo -->
<div class="modal fade" id="deletePromoModal" tabindex="-1" aria-labelledby="deletePromoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePromoLabel">Konfirmasi Hapus Promo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus promo ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="confirmDeletePromoBtn" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('pesan') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url('admin/promo/tambah') ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Promo
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga Asli</th>
                                        <th>Diskon</th>
                                        <th>Harga Promo</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($promos as $promo) : 
                                        $discounted_price = $promo['original_price'] - ($promo['original_price'] * $promo['discount_percentage'] / 100);
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $promo['nama_produk'] ?></td>
                                            <td><?= $promo['nama_type'] ?></td>
                                            <td>Rp <?= number_format($promo['original_price'], 0, ',', '.') ?></td>
                                            <td><?= $promo['discount_percentage'] ?>%</td>
                                            <td>Rp <?= number_format($discounted_price, 0, ',', '.') ?></td>
                                            <td>
                                                <?= date('d/m/Y', strtotime($promo['start_date'])) ?> - 
                                                <?= date('d/m/Y', strtotime($promo['end_date'])) ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?= $promo['status'] == 'active' ? 'success' : 'danger' ?>">
                                                    <?= ucfirst($promo['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/promo/edit/' . $promo['id']) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletePromo(<?= $promo['id'] ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDeletePromo(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Promo yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('admin/promo/delete/'); ?>" + id;
        }
    });
}
$(document).ready(function() {
    $('#table-1').DataTable();
});
</script>
