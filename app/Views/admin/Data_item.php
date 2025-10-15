<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Produk</h1>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('pesan') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/data_item/tambah_item') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <th>Berat/Volume</th>
                                <th width="8%">Stok</th>
                                <th width="12%">Harga Beli</th>
                                <th width="12%">Harga Jual</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1 + (8 * ($currentPage - 1));
                            foreach ($item as $mb) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-center">
                                        <img style="height: 50px; width: auto;" src="<?= base_url('assets/upload/' . $mb['gambar']); ?>" alt="Gambar <?= $mb['nama_produk'] ?>">
                                    </td>
                                    <td><?= esc($mb['nama_produk']) ?></td>
                                    <td><?= esc($mb['brand']) ?></td>
                                    <td><?= esc($mb['berat']) ?></td>
                                    <td class="text-center"><?= $mb['stok'] ?></td>
                                    <td>Rp <?= number_format($mb['harga_beli'] ?? 0, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($mb['harga_jual'] ?? 0, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= $mb['status'] == "0" ? 'danger' : 'success' ?>">
                                            <?= $mb['status'] == "0" ? 'Tidak Tersedia' : 'Tersedia' ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= base_url('admin/data_item/detail_item/' . $mb['id_item']) ?>" 
                                               class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('admin/data_item/update_item/' . $mb['id_item']) ?>" 
                                               class="btn btn-primary btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button onclick="confirmDelete(<?= $mb['id_item'] ?>)" 
                                                    class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button onclick="toggleFeatured(<?= $mb['id_item'] ?>)" 
                                                    class="btn btn-<?= isset($mb['is_featured']) && $mb['is_featured'] ? 'warning' : 'secondary' ?> btn-sm featured-toggle" 
                                                    data-id="<?= $mb['id_item'] ?>"
                                                    title="<?= isset($mb['is_featured']) && $mb['is_featured'] ? 'Produk Unggulan' : 'Jadikan Produk Unggulan' ?>">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Links -->
                <div class="card-footer">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('admin/data_item/delete_item/'); ?>" + id;
        }
    });
}

function toggleFeatured(itemId) {
    fetch(`<?= base_url('admin/data_item/toggleFeatured/') ?>/${itemId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = document.querySelector(`.featured-toggle[data-id="${itemId}"]`);
            if (data.featured) {
                button.classList.remove('btn-secondary');
                button.classList.add('btn-warning');
            } else {
                button.classList.remove('btn-warning');
                button.classList.add('btn-secondary');
            }
            alert(data.message);
        } else {
            alert('Failed to update featured status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update featured status');
    });
}
</script>