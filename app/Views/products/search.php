<?php 
$themeColor = '#6BB252';
?>
<style>
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
                    <a href="<?= base_url('products/search') ?>" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= empty($selected_type) ? 'active' : '' ?>">
                        <span><i class="fas fa-th-large me-2"></i>Semua Kategori</span>
                        <span class="badge bg-primary rounded-pill"><?= array_sum(array_column($categories, 'jumlah')) ?></span>
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="<?= base_url('products/search?type=' . $category['kode_type'] . ($keyword ? '&keyword=' . $keyword : '')) ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $selected_type == $category['kode_type'] ? 'active' : '' ?>">
                            <span><i class="<?= $category['icon'] ?? 'fas fa-tag' ?> me-2"></i><?= $category['nama_type'] ?></span>
                            <span class="badge bg-primary rounded-pill"><?= $category['jumlah'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Content -->
        <div class="col-md-9">
            <!-- Search Results Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <?php if (!empty($keyword)): ?>
                            Hasil Pencarian untuk "<?= esc($keyword) ?>"
                            <?php if (!empty($selected_type)): ?>
                                in <?= $categories[array_search($selected_type, array_column($categories, 'kode_type'))]['nama_type'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?= $selected_type ? $categories[array_search($selected_type, array_column($categories, 'kode_type'))]['nama_type'] : 'All Products' ?>
                        <?php endif; ?>
                        <span class="text-muted fs-6">(Ditemukan <?= count($items) ?> Produk)</span>
                    </h5>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row g-4">
                <!-- Skeleton Loader dan produk dalam satu grid row -->
                <?php for ($i = 0; $i < 8; $i++): ?>
                    <div id="search-skeleton" class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100">
                            <div class="skeleton-img mb-2"></div>
                            <div class="skeleton-text w-75 mb-1"></div>
                            <div class="skeleton-text w-50 mb-2"></div>
                            <div class="skeleton-btn"></div>
                        </div>
                    </div>
                <?php endfor; ?>
                <?php foreach ($items as $item): 
                    $hasDiscount = isset($item['discount_percentage']) && $item['discount_percentage'] > 0;
                    $discountedPrice = $hasDiscount ? 
                        $item['harga'] - ($item['harga'] * $item['discount_percentage'] / 100) : 
                        $item['harga'];
                ?>
                    <div id="search-content" style="display:none;" class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100" onclick="addToCart(<?= $item['id_item'] ?>)">
                            <div class="position-relative overflow-hidden">
                                <a href="<?= base_url('customer/data_item/detail_item/' . $item['id_item']) ?>">
                                    <img src="<?= base_url('assets/upload/' . $item['gambar']) ?>" 
                                         class="card-img-top product-img" 
                                         alt="<?= $item['nama_produk'] ?>">
                                </a>
                                <?php if ($hasDiscount): ?>
                                    <div class="discount-badge">
                                        -<?= $item['discount_percentage'] ?>%
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="<?= base_url('customer/data_item/detail_item/' . $item['id_item']) ?>" class="product-title">
                                    <h6 class="card-title text-truncate mb-1"><?= $item['nama_produk'] ?></h6>
                                </a>
                                <p class="card-text text-muted small mb-2"><?= $item['nama_type'] ?></p>
                                <div class="price-section mt-auto">
                                    <?php if ($hasDiscount): ?>
                                        <p class="mb-1">
                                            <span class="text-decoration-line-through text-muted small">
                                                Rp<?= number_format($item['harga'], 0, ',', '.') ?>
                                            </span>
                                            <span class="ms-2 text-danger fw-bold">
                                                Rp<?= number_format($discountedPrice, 0, ',', '.') ?>
                                            </span>
                                        </p>
                                    <?php else: ?>
                                        <p class="fw-bold mb-1">
                                            Rp<?= number_format($item['harga'], 0, ',', '.') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <button onclick="event.stopPropagation(); addToCart(<?= $item['id_item'] ?>)" 
                                        class="btn btn-primary btn-sm btn-cart w-100">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
            <?php if (isset($pager) && !empty($items)): ?>
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
                <h5 class="modal-title">Add to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <input type="hidden" id="selectedItemId">
                <div class="mb-4">
                    <label for="itemQuantity" class="form-label">Quantity:</label>
                    <div class="input-group w-50 mx-auto">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('decrease')">-</button>
                        <input type="number" class="form-control text-center" id="itemQuantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity('increase')">+</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmAddToCart()">Add to Cart</button>
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
                <h5 class="mb-3">Added to Cart!</h5>
                <p class="text-muted mb-0" id="successMessage"></p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Continue Shopping</button>
                <a href="<?= base_url('cart') ?>" class="btn btn-primary">View Cart</a>
            </div>
        </div>
    </div>
</div>

<script>
// Skeleton loader logic
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const skeletons = document.querySelectorAll('#search-skeleton');
        skeletons.forEach(el => el.style.display = 'none');
        const products = document.querySelectorAll('#search-content');
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
            document.getElementById('successMessage').textContent = data.message;
            new bootstrap.Modal(document.getElementById('successModal')).show();
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
