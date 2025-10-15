<?php 
$themeColor = '#6BB252';
?>
<style>
.list-group-item.active {
    background-color: <?= $themeColor ?> !important;
    border-color: <?= $themeColor ?> !important;
}

.badge.bg-primary {
    background-color: <?= $themeColor ?> !important;
}

.product-card {
    transition: all 0.3s ease;
    border: none !important;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}

.product-img {
    height: 200px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.product-title {
    color: inherit;
    text-decoration: none;
}

.product-title:hover {
    color: <?= $themeColor ?>;
    text-decoration: none;
}

.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: bold;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.price-section {
    min-height: 50px;
}

.btn-cart {
    transition: all 0.3s ease;
}

.btn-cart:hover {
    transform: scale(1.1);
}
/* Overlay untuk gambar stok habis */
.out-stock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    z-index: 2;
    border-radius: 0.5rem;
}
.product-img.out-of-stock {
    filter: grayscale(0.3) brightness(0.9);
}
/* Skeleton Loader */
.skeleton-img {
    width: 100%;
    height: 200px;
    background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
    border-radius: 0.5rem;
    animation: skeleton-loading 1.2s infinite linear;
}
.skeleton-text {
    height: 18px;
    background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
    border-radius: 4px;
    animation: skeleton-loading 1.2s infinite linear;
}
.skeleton-btn {
    width: 100%;
    height: 32px;
    background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
    border-radius: 8px;
    animation: skeleton-loading 1.2s infinite linear;
}
@keyframes skeleton-loading {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}
</style>

<div class="container-fluid py-5">
    <div class="row">
        <!-- Categories Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Kategori</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="<?= base_url('products') ?>" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= !$currentType ? 'active' : '' ?>">
                        <span><i class="fas fa-th-large me-2"></i>Semua Kategori</span>
                        <span class="badge bg-primary rounded-pill"><?= array_sum(array_column($types, 'jumlah')) ?></span>
                    </a>
                    <?php foreach ($types as $type): ?>
                        <a href="<?= base_url('products?type=' . $type['kode_type']) ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $currentType === $type['kode_type'] ? 'active' : '' ?>">
                            <span><i class="<?= $type['icon'] ?? 'fas fa-tag' ?> me-2"></i><?= $type['nama_type'] ?></span>
                            <span class="badge bg-primary rounded-pill"><?= $type['jumlah'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Content -->
        <div class="col-md-9">
            <!-- Sort Options -->
            <div class="card shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <?= $currentType ? $types[array_search($currentType, array_column($types, 'kode_type'))]['nama_type'] : 'Semua Produk' ?>
                    </h5>
                    <div class="d-flex gap-3 align-items-center">
                        <label class="mb-0">Urutkan berdasarkan:</label>
                        <select class="form-select form-select-sm" style="width: 200px;" onchange="window.location.href=this.value">
                            <option value="<?= base_url('products' . ($currentType ? '?type=' . $currentType : '')) ?>" <?= !isset($_GET['sort']) ? 'selected' : '' ?>>Default</option>
                            <option value="<?= base_url('products' . ($currentType ? '?type=' . $currentType . '&' : '?') . 'sort=price_asc') ?>" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Harga: Rendah ke Tinggi</option>
                            <option value="<?= base_url('products' . ($currentType ? '?type=' . $currentType . '&' : '?') . 'sort=price_desc') ?>" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Harga: Tinggi ke Rendah</option>
                            <option value="<?= base_url('products' . ($currentType ? '?type=' . $currentType . '&' : '?') . 'sort=name_asc') ?>" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : '' ?>>Nama: A ke Z</option>
                            <option value="<?= base_url('products' . ($currentType ? '?type=' . $currentType . '&' : '?') . 'sort=name_desc') ?>" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : '' ?>>Nama: Z ke A</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row g-4">
                <!-- Skeleton Placeholder & Product Content dalam satu grid row -->
                <div id="product-grid" class="row g-4">
                    <?php if (!empty($items)): ?>
                        <?php for ($i = 0; $i < 8; $i++): ?>
                        <div id="product-skeleton" class="col-6 col-md-4 col-lg-3">
                            <div class="card product-card h-100">
                                <div class="skeleton-img mb-2"></div>
                                <div class="skeleton-text w-75 mb-1"></div>
                                <div class="skeleton-text w-50 mb-2"></div>
                                <div class="skeleton-btn"></div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php foreach ($items as $item): 
                        $hasDiscount = isset($item['discount_percentage']) && $item['discount_percentage'] > 0;
                        $discountedPrice = $hasDiscount ? 
                            $item['harga_jual'] - ($item['harga_jual'] * $item['discount_percentage'] / 100) : 
                            $item['harga_jual'];
                        $detailUrl = base_url('customer/data_item/detail_item/' . $item['id_item']);
                    ?>
                        <div id="product-content" style="display:none;" class="col-6 col-md-4 col-lg-3">
                            <div class="card product-card h-100">
                                <a href="<?= $detailUrl ?>" class="text-decoration-none">
                                    <div class="position-relative overflow-hidden">
                                        <img src="<?= base_url('assets/upload/' . $item['gambar']) ?>" 
                                             class="card-img-top product-img<?= $item['stok'] <= 0 ? ' out-of-stock' : '' ?>" 
                                             alt="<?= $item['nama_produk'] ?>">
                                        <?php if ($item['stok'] <= 0): ?>
                                            <div class="out-stock-overlay"></div>
                                        <?php endif; ?>
                                        <?php if ($hasDiscount): ?>
                                            <div class="discount-badge">
                                                -<?= $item['discount_percentage'] ?>%
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title text-truncate mb-1 text-dark"><?= $item['nama_produk'] ?></h6>
                                        <p class="card-text text-muted small mb-2"><?= $item['nama_type'] ?></p>
                                        <div class="price-section mt-auto mb-2">
                                            <?php if ($hasDiscount): ?>
                                                <p class="mb-1">
                                                    <span class="text-decoration-line-through text-muted small">
                                                        Rp<?= number_format($item['harga_jual'], 0, ',', '.') ?>
                                                    </span>
                                                    <span class="ms-2 text-danger fw-bold">
                                                        Rp<?= number_format($discountedPrice, 0, ',', '.') ?>
                                                    </span>
                                                </p>
                                            <?php else: ?>
                                                <p class="fw-bold mb-1">
                                                    Rp<?= number_format($item['harga_jual'], 0, ',', '.') ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                                <?php if ($item['stok'] > 0): ?>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <button onclick="addToCart(<?= $item['id_item'] ?>)" 
                                                class="btn btn-primary btn-sm w-100">
                                            <i class="fas fa-cart-plus me-2"></i>Tambahkan Keranjang
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <button class="btn btn-secondary btn-sm w-100" disabled>
                                            <i class="fas fa-times-circle me-2"></i>Stok Habis
                                        </button>
                                        <small class="text-danger d-block mt-1 text-center">Tidak Tersedia</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Empty State -->
            <?php if (empty($items)): ?>
                <div class="text-center py-5">
                    <img src="<?= base_url('assets/assets_dashboard/images/empty-state.png') ?>" 
                         alt="No products found" 
                         class="img-fluid mb-3" 
                         style="max-width: 200px;">
                    <h4>No Products Found</h4>
                    <p class="text-muted">We couldn't find any products matching your criteria.</p>
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if ($pager && !empty($items)): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Cart Notification Modal -->
<div class="modal fade" id="cartNotificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Tambah Kerajang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <input type="hidden" id="selectedItemId">
                <div class="mb-4">
                    <label for="itemQuantity" class="form-label">Jumlah:</label>
                    <div class="input-group w-50 mx-auto">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('decrease')">-</button>
                        <input type="number" class="form-control text-center" id="itemQuantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('increase')">+</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="confirmAddToCart()">Tambah Keranjang</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-check-circle text-success mb-4" style="font-size: 48px;"></i>
                <h5 class="mb-3">Berhasil Ditambahkan ke Keranjang!</h5>
                <p class="text-muted mb-0" id="successMessage"></p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Lanjutkan Belanja</button>
                <a href="<?= base_url('cart') ?>" class="btn btn-primary">Lihat Keranjang</a>
            </div>
        </div>
    </div>
</div>

<script>
// Skeleton loader logic
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const skeletons = document.querySelectorAll('#product-skeleton');
        skeletons.forEach(el => el.style.display = 'none');
        const products = document.querySelectorAll('#product-content');
        products.forEach(el => el.style.display = 'block');
    }, 1200); // Simulasi loading 1.2 detik
});
function updateQuantity(action) {
    const quantityInput = document.getElementById('itemQuantity');
    let currentValue = parseInt(quantityInput.value);
    
    if (action === 'increase') {
        quantityInput.value = currentValue + 1;
    } else if (action === 'decrease' && currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function addToCart(itemId) {
    document.getElementById('selectedItemId').value = itemId;
    document.getElementById('itemQuantity').value = 1;
    new bootstrap.Modal(document.getElementById('cartNotificationModal')).show();
}

function confirmAddToCart() {
    const itemId = document.getElementById('selectedItemId').value;
    const quantity = document.getElementById('itemQuantity').value;

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
            // Hide quantity modal
            bootstrap.Modal.getInstance(document.getElementById('cartNotificationModal')).hide();
            // Update success message and show success modal
            document.getElementById('successMessage').textContent;
            new bootstrap.Modal(document.getElementById('successModal')).show();
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

// Prevent form submission when user presses enter on quantity input
document.getElementById('itemQuantity').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        confirmAddToCart();
    }
});
</script>
