<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Produk Unggulan</h1>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Produk</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button class="btn btn-primary" onclick="showFeatured()">Produk Unggulan</button>
                                    <button class="btn btn-outline-primary" onclick="showAll()">Semua Produk</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="productsTable">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Unggulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr class="product-row <?= $product['is_featured'] ? 'featured' : '' ?>">
                                            <td>
                                                <img src="<?= base_url('assets/upload/' . $product['gambar']) ?>" 
                                                     alt="<?= $product['nama_produk'] ?>" 
                                                     width="50">
                                            </td>
                                            <td><?= $product['nama_produk'] ?></td>
                                            <td><?= $product['nama_type'] ?></td>
                                            <td>Rp <?= number_format($product['harga_jual'], 0, ',', '.') ?></td>
                                            <td>
                                                <span class="badge badge-<?= $product['status'] == '1' ? 'success' : 'danger' ?>">
                                                    <?= $product['status'] == '1' ? 'Tersedia' : 'Tidak Tersedia' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" 
                                                           class="custom-control-input featured-toggle" 
                                                           id="featured_<?= $product['id_item'] ?>"
                                                           <?= $product['is_featured'] ? 'checked' : '' ?>
                                                           onchange="toggleFeatured(<?= $product['id_item'] ?>)">
                                                    <label class="custom-control-label" for="featured_<?= $product['id_item'] ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/data_item/detail_item/' . $product['id_item']) ?>" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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

<script>
$(document).ready(function() {
    const table = $('#productsTable').DataTable({
        "order": [[5, "desc"]], // Sort by featured status
        "pageLength": 25
    });

    // Search functionality
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});

function showFeatured() {
    $('.product-row').hide();
    $('.product-row.featured').show();
}

function showAll() {
    $('.product-row').show();
}

function toggleFeatured(itemId) {
    fetch(`<?= base_url('admin/featured-products/toggle/') ?>/${itemId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = $(`#featured_${itemId}`).closest('tr');
            if (data.featured) {
                row.addClass('featured');
            } else {
                row.removeClass('featured');
            }
            // Show notification
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal mengubah status produk unggulan'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan sistem'
        });
    });
}
</script>

<style>
.featured {
    background-color: rgba(255, 193, 7, 0.1) !important;
}
</style>