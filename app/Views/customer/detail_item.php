<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0">
                <img src="<?= base_url('assets/upload/' . $item['gambar']) ?>" 
                     class="card-img-top" 
                     alt="<?= $item['nama_produk'] ?>"
                     style="height: 400px; object-fit: contain;">
            </div>
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('products') ?>">Belanja</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $item['nama_produk'] ?></li>
                </ol>
            </nav>
            <h2 class="mb-3"><?= $item['nama_produk'] ?></h2>
            <p class="text-muted mb-4">Kategori: <?= $item['nama_type'] ?></p>

            <?php if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0): 
                $discountedPrice = $item['harga_jual'] - ($item['harga_jual'] * $item['discount_percentage'] / 100);
            ?>
                <div class="mb-3">
                    <span class="badge bg-danger mb-2">-<?= $item['discount_percentage'] ?>% Diskon </span>
                    <div class="h4">
                        <span class="text-decoration-line-through text-muted">
                            Rp<?= number_format($item['harga_jual'], 0, ',', '.') ?>
                        </span>
                        <br>
                        <span class="text-danger">
                            Rp<?= number_format($discountedPrice, 0, ',', '.') ?>
                        </span>
                    </div>
                    <small class="text-muted">*Promo berlaku sampai <?= date('d F Y', strtotime($item['promo_end_date'])) ?></small>
                </div>
            <?php else: ?>
                <div class="h4 mb-3">Rp<?= number_format($item['harga_jual'], 0, ',', '.') ?></div>
            <?php endif; ?>

            <div class="mb-4">
                <h5>Deskripsi:</h5>
                <p><?= nl2br($item['deskripsi']) ?></p>
            </div>

            <?php if ($item['stok'] > 0): ?>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="input-group" style="width: 130px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('decrease')">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="<?= $item['stok'] ?>">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('increase')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart(<?= $item['id_item'] ?>)">
                        <i class="fas fa-cart-plus me-2"></i>tambahkan ke keranjang
                    </button>
                </div>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>Stok Tersedia (<?= $item['stok'] ?> Produk Tersedia)
                </div>
            <?php else: ?>
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-times-circle me-2"></i>Stok Habis
                </div>
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-shopping-cart me-2"></i>Tidak Tersedia Saat Ini
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Suggested Items Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="mb-4">Produk Terkait</h3>
        <?php if (!empty($suggested_items)) : ?>
            <div class="row g-4">
                <?php foreach ($suggested_items as $suggested_item) : 
                    $hasDiscount = isset($suggested_item['discount_percentage']) && $suggested_item['discount_percentage'] > 0;
                    $discountedPrice = $hasDiscount ? 
                        $suggested_item['harga_jual'] - ($suggested_item['harga_jual'] * $suggested_item['discount_percentage'] / 100) : 
                        $suggested_item['harga_jual'];
                ?>
                    <div class="col-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <a href="<?= base_url('customer/data_item/detail_item/' . $suggested_item['id_item']) ?>">
                                    <img src="<?= base_url('assets/upload/' . $suggested_item['gambar']) ?>" 
                                         class="card-img-top" 
                                         alt="<?= $suggested_item['nama_produk'] ?>"
                                         style="height: 200px; object-fit: cover;">
                                    <?php if ($hasDiscount): ?>
                                        <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                            -<?= $suggested_item['discount_percentage'] ?>%
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($suggested_item['stok'] <= 0): ?>
                                        <div class="position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                                             style="background: rgba(0,0,0,0.5);">
                                            <h5 class="text-white mb-0">Stok Habis</h5>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">
                                    <a href="<?= base_url('customer/data_item/detail_item/' . $suggested_item['id_item']) ?>" 
                                       class="text-decoration-none text-dark">
                                        <?= $suggested_item['nama_produk'] ?>
                                    </a>
                                </h5>
                                <p class="text-muted mb-2"><?= $suggested_item['nama_type'] ?></p>
                                <?php if ($hasDiscount): ?>
                                    <p class="mb-1">
                                        <span class="text-decoration-line-through text-muted">
                                            Rp<?= number_format($suggested_item['harga_jual'], 0, ',', '.') ?>
                                        </span>
                                        <span class="ms-2 text-danger fw-bold">
                                            Rp<?= number_format($discountedPrice, 0, ',', '.') ?>
                                        </span>
                                    </p>
                                <?php else: ?>
                                    <p class="fw-bold mb-1">
                                        Rp<?= number_format($suggested_item['harga_jual'], 0, ',', '.') ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($suggested_item['stok'] > 0): ?>
                                    <div class="mt-2">
                                        <small class="text-success">
                                            <i class="fas fa-check-circle"></i> Stok tersedia (<?= $suggested_item['stok'] ?>)
                                        </small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="<?= base_url('customer/data_item/detail_item/' . $suggested_item['id_item']) ?>" 
                                   class="btn <?= $suggested_item['stok'] > 0 ? 'btn-primary' : 'btn-secondary' ?> w-100">
                                    <?= $suggested_item['stok'] > 0 ? 'Lihat Detail' : 'Stok Habis - Lihat Detail' ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                
                
            <?php else: ?>
                <div class="text-center text-muted">
                    <p>Tidak ada produk terkait untuk saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

<!-- Modal Notifikasi -->
<div class="modal fade" id="cartNotificationModal" tabindex="-1" aria-labelledby="cartNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartNotificationModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 48px;"></i>
                <p>Berhasil Ditambahkan ke Keranjang!</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjutkan Belanja</button>
                <a href="<?= base_url('cart') ?>" class="btn btn-primary">Lihat Kerajang</a>
            </div>
        </div>
    </div>
</div>

<script>
function updateQuantity(action) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value);
    
    if (action === 'increase') {
        currentQuantity++;
    } else if (action === 'decrease' && currentQuantity > 1) {
        currentQuantity--;
    }
    
    quantityInput.value = currentQuantity;
}

function addToCart(itemId) {
    const quantity = parseInt(document.getElementById('quantity').value);
    fetch(`/cart/add/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.dispatchEvent(new CustomEvent('cartUpdated', {
                detail: { count: data.itemCount }
            }));
            var modal = new bootstrap.Modal(document.getElementById('cartNotificationModal'));
            modal.show();
            // Update isi keranjang di header
            if (typeof reloadOffcanvasCart === 'function') reloadOffcanvasCart();
        } else {
            if (data.message === 'Please login first') {
                window.location.href = '/login';
            } else {
                alert(data.message || 'Failed to add item to cart');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add item to cart');
    });
}
</script>
