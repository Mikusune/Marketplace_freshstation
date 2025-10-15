<div class="container d-flex flex-column flex-sm-row align-items-sm-center justify-content-between position-relative">
    <nav class="mb-3 mb-sm-0">
        <ul class="list-unstyled d-flex flex-wrap gap-2 mb-0 small text-secondary">
            <li>Home</li>
            <li>/</li>
            <li>Pages</li>
            <li>/</li>
            <li>keranjang</li>
        </ul>
    </nav>
    <h1 class="mb-0">Keranjang</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<main class="container py-5 d-flex flex-column flex-lg-row gap-4">
    <!-- Cart Items -->
    <section class="flex-grow-1">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="w-50">Produk</th>
                    <th scope="col" class="text-center w-25">jumlah barang</th>
                    <th scope="col" class="text-end w-25">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): 
                    $price = $item['harga_jual'];
                    $discounted_price = $price;
                    if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
                        $discounted_price = $price - ($price * $item['discount_percentage'] / 100);
                    }
                    $subtotal = $discounted_price * $item['quantity'];
                ?>
                    <tr data-cart-id="<?= $item['id'] ?>">
                        <td class="d-flex align-items-center gap-3">
                            <img alt="<?= $item['nama_produk'] ?>" class="img-fluid" height="60" src="<?= base_url('assets/upload/' . $item['gambar']) ?>" width="60"/>
                            <div>
                                <span class="product-name"><?= $item['nama_produk'] ?></span>
                                <?php if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0): ?>
                                    <div class="text-danger">
                                        <small class="text-decoration-line-through">Rp<?= number_format($price, 0, ',', '.') ?></small>
                                        <span class="badge bg-danger">-<?= $item['discount_percentage'] ?>%</span>
                                    </div>
                                    <div>Rp<?= number_format($discounted_price, 0, ',', '.') ?></div>
                                <?php else: ?>
                                    <div>Rp<?= number_format($price, 0, ',', '.') ?></div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-inline-flex align-items-center gap-1">
                                <button aria-label="Decrease quantity" class="quantity-btn" type="button" onclick="updateQuantity('<?= $item['id'] ?>', 'decrease')">−</button>
                                <input class="quantity-input" readonly="" type="text" value="<?= $item['quantity'] ?>" id="quantity-<?= $item['id'] ?>">
                                <button aria-label="Increase quantity" class="quantity-btn" type="button" onclick="updateQuantity('<?= $item['id'] ?>', 'increase')">+</button>
                            </div>
                        </td>
                        <td class="text-end align-middle d-flex justify-content-end align-items-center gap-3">
                            <span class="subtotal-text" data-subtotal-id="<?= $item['id'] ?>">Rp<?= number_format($subtotal, 0, ',', '.') ?></span>
                            <button aria-label="Remove product" class="btn-trash" type="button" onclick="removeItem('<?= $item['id'] ?>')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Cart Summary -->
    <aside class="w-100 w-lg-auto cart-aside">
        <h2 class="cart-total-title">Total</h2>
        <div class="cart-total-box">
            <?php
            $cartTotal = 0;
            foreach ($cartItems as $item) {
                $price = $item['harga_jual'];
                if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
                    $price = $price - ($price * $item['discount_percentage'] / 100);
                }
                $cartTotal += $price * $item['quantity'];
            }
            ?>
            <div>
                <span>Subtotal</span>
                <span class="cart-total-amount">Rp<?= number_format($cartTotal, 0, ',', '.') ?></span>
            </div>
        </div>
        <div class="d-flex gap-3 mb-3">
            <button class="btn-continue w-100" type="button" onclick="continueShopping()">Lanjutkan Belanja</button>
        </div>
        <button class="btn-checkout" id="pay-button" type="button" <?= empty($cartItems) ? 'disabled' : '' ?>>
            Lanjutkan ke Pembayaran
        </button>
    </aside>
</main>

<!-- Shipping Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Informasi pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="address-list-section">
                    <label for="address-list" class="form-label">Pilih Alamat Pengiriman</label>
                    <select id="address-list" class="form-select mb-2">
                        <option value="">-- Pilih alamat --</option>
                        <?php if (!empty($userAddresses)): ?>
                            <?php foreach ($userAddresses as $addr): ?>
                                <option value="<?= $addr['id'] ?>" data-address="<?= htmlspecialchars($addr['address']) ?>" data-lat="<?= $addr['latitude'] ?>" data-lon="<?= $addr['longitude'] ?>">
                                    <?= htmlspecialchars($addr['address']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <a href="<?= base_url('customer/addresses') ?>" class="btn btn-link btn-sm mb-3">Kelola Alamat</a>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ongkir Toko (otomatis dihitung per km)</label>
                    <div id="courier-service-note" class="form-text text-muted"></div>
                </div>
                <div class="card mt-4">
                    <!-- Rincian Belanja hanya satu kali -->
                    <div class="card-header">
                        <h6 class="mb-0">Rincian Belanja</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>Rp<?= number_format($cartTotal, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Pengiriman:</span>
                            <span id="modal-shipping-cost">Rp0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span id="modal-total-cost">Rp<?= number_format($cartTotal, 2) ?></span>
                        </div>
                    </div>
                </div>
<script>
// --- Ongkir toko per km ---
const addressList = document.getElementById('address-list');
const pricePerKm = <?= isset($shippingConfig['price_per_km']) ? $shippingConfig['price_per_km'] : 5000 ?>;
const maxDistance = 10; // km, batas maksimal pengiriman

addressList.addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    if (!selected.value) {
        document.getElementById('courier-service-note').textContent = '';
        document.getElementById('modal-shipping-cost').textContent = 'Rp0';
        document.getElementById('modal-total-cost').textContent = 'Rp<?= number_format($cartTotal, 2) ?>';
        document.getElementById('proceedPaymentBtn').disabled = true;
        return;
    }
    const destLat = selected.getAttribute('data-lat');
    const destLon = selected.getAttribute('data-lon');
    const address = selected.getAttribute('data-address');
    // Hitung ongkir
    calculateOngkirToko(destLat, destLon);
    // Simpan ke data attribute untuk proses payment
    document.getElementById('proceedPaymentBtn').dataset.address = address;
    document.getElementById('proceedPaymentBtn').dataset.latitude = destLat;
    document.getElementById('proceedPaymentBtn').dataset.longitude = destLon;
});

function calculateOngkirToko(destLat, destLon) {
    const originLat = -6.249167; // Gudang
    const originLon = 106.791778;
    const osrmUrl = `https://router.project-osrm.org/route/v1/driving/${originLon},${originLat};${destLon},${destLat}?overview=false`;
    fetch(osrmUrl)
        .then(res => res.json())
        .then(data => {
            if (!data.routes || !data.routes[0]) {
                document.getElementById('modal-shipping-cost').textContent = 'Rp0';
                document.getElementById('modal-total-cost').textContent = 'Rp<?= number_format($cartTotal, 2) ?>';
                document.getElementById('courier-service-note').textContent = 'Gagal menghitung jarak.';
                document.getElementById('proceedPaymentBtn').disabled = true;
                return;
            }
            const distanceMeters = data.routes[0].distance;
            const distanceKm = Math.ceil(distanceMeters / 1000);
            if (distanceKm > maxDistance) {
                document.getElementById('modal-shipping-cost').textContent = 'Rp0';
                document.getElementById('modal-total-cost').textContent = 'Rp<?= number_format($cartTotal, 2) ?>';
                document.getElementById('courier-service-note').textContent = `Alamat di luar jangkauan pengiriman (> ${maxDistance} km).`;
                document.getElementById('proceedPaymentBtn').disabled = true;
                return;
            }
            const ongkir = distanceKm * pricePerKm;
            document.getElementById('modal-shipping-cost').textContent = 'Rp' + ongkir.toLocaleString();
            document.getElementById('modal-total-cost').textContent = 'Rp' + (<?= $cartTotal ?> + ongkir).toLocaleString();
            document.getElementById('courier-service-note').textContent = `Estimasi jarak: ${distanceKm} km. Ongkir toko: Rp${ongkir.toLocaleString()}`;
            document.getElementById('proceedPaymentBtn').disabled = false;
        })
        .catch(() => {
            document.getElementById('modal-shipping-cost').textContent = 'Rp0';
            document.getElementById('modal-total-cost').textContent = 'Rp<?= number_format($cartTotal, 2) ?>';
            document.getElementById('courier-service-note').textContent = 'Gagal menghitung ongkir.';
            document.getElementById('proceedPaymentBtn').disabled = true;
        });
}
</script>
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Inisialisasi peta Leaflet di modal shipping (koordinat default: -6.249167, 106.791778)
let map, marker;
const defaultLat = -6.249167; // Gudang baru
const defaultLon = 106.791778;
const mapModal = document.getElementById('shippingModal');
mapModal.addEventListener('shown.bs.modal', function () {
    setTimeout(() => {
        if (!map) {
            map = L.map('map').setView([defaultLat, defaultLon], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            marker = L.marker([defaultLat, defaultLon], {draggable:true}).addTo(map);
            // Update field saat marker dipindah
            marker.on('dragend', function(e) {
                const {lat, lng} = marker.getLatLng();
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            });
            // Klik peta untuk pindah marker
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
            });
        } else {
            map.invalidateSize();
        }
    }, 300);
});
// Set lat/lon ke field saat modal dibuka
mapModal.addEventListener('show.bs.modal', function () {
    document.getElementById('latitude').value = defaultLat;
    document.getElementById('longitude').value = defaultLon;
});
</script>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="proceedPaymentBtn" onclick="proceedToPayment()">
                  <span id="loadingSpinner" class="spinner-border spinner-border-sm me-2" style="display:none;" role="status" aria-hidden="true"></span>
                  Lanjutkan Ke Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>
<script>
    const csrf_token = '<?= csrf_token() ?>';
    const csrf_hash = '<?= csrf_hash() ?>';
    
    document.getElementById('pay-button').addEventListener('click', function() {
        if (this.disabled) {
            alert('Keranjang belanja Anda kosong');
            return;
        }
        const modal = new bootstrap.Modal(document.getElementById('shippingModal'));
        modal.show();
        // Otomatis pilih alamat pertama jika ada, dan trigger event agar tombol enable
        setTimeout(() => {
            const addressList = document.getElementById('address-list');
            if (addressList && addressList.options.length > 1) {
                // Jika belum ada yang dipilih, pilih yang pertama (bukan option kosong)
                if (!addressList.value) {
                    addressList.selectedIndex = 1;
                    addressList.dispatchEvent(new Event('change'));
                } else {
                    addressList.dispatchEvent(new Event('change'));
                }
            } else {
                document.getElementById('proceedPaymentBtn').disabled = true;
            }
        }, 200);
    });



    function proceedToPayment() {
    const proceedBtn = document.getElementById('proceedPaymentBtn');
    const address = proceedBtn.dataset.address;
    const latitude = proceedBtn.dataset.latitude;
    const longitude = proceedBtn.dataset.longitude;
    const shippingCost = Number(document.getElementById('modal-shipping-cost').textContent.replace(/[^\d]/g, ''));
    const cartTotal = <?= $cartTotal ?>;
    const totalCost = cartTotal + shippingCost;
    const spinner = document.getElementById('loadingSpinner');

        if (!address || !latitude || !longitude || shippingCost === 0) {
            alert('Mohon pilih alamat pengiriman dan pastikan ongkir sudah dihitung.');
            return;
        }

        spinner.style.display = 'inline-block';
        proceedBtn.disabled = true;

        fetch('<?= base_url("payment/createTransaction") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrf_hash
            },
            body: JSON.stringify({
                address: address,
                shipping_cost: shippingCost,
                total_amount: totalCost,
                latitude: latitude,
                longitude: longitude,
                items: <?= json_encode($cartItems) ?>
            })
        })
        .then(response => response.json())
        .then(data => {
            spinner.style.display = 'none';
            proceedBtn.disabled = false;
            if (data.success && data.snapToken) {
                const shippingModal = bootstrap.Modal.getInstance(document.getElementById('shippingModal'));
                shippingModal.hide();
                window.snap.pay(data.snapToken, {
                    onSuccess: function(result) {
                        fetch('<?= base_url('payment/updateStockAfterPayment') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrf_hash
                            },
                            body: JSON.stringify({ order_id: result.order_id })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if(res.success) {
                                alert('Pembayaran berhasil dan stok sudah dikurangi!');
                            } else {
                                alert('Pembayaran berhasil, tapi gagal update stok: ' + (res.message || 'Unknown error'));
                            }
                            window.location.href = '<?= base_url("customer/orders") ?>';
                        })
                        .catch(err => {
                            alert('Pembayaran berhasil, tapi gagal update stok!');
                            window.location.href = '<?= base_url("customer/orders") ?>';
                        });
                    },
                    onPending: function(result) {
                        alert('Menunggu pembayaran Anda');
                        window.location.href = '<?= base_url("customer/orders") ?>';
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal: ' + result.status_message);
                        console.error('Payment Error:', result);
                    },
                    onClose: function() {
                        alert('Anda menutup popup pembayaran tanpa menyelesaikan pembayaran');
                    }
                });
            } else {
                alert('Gagal membuat transaksi: ' + (data.message || 'Unknown error'));
                console.error('Transaction Error:', data);
            }
        })
        .catch(error => {
            spinner.style.display = 'none';
            proceedBtn.disabled = false;
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses pembayaran Anda');
        });
    }

    // Ganti validasi jarak: tanpa Google Maps API
    const warehouseLat = -6.369028;
    const warehouseLon = 106.822456;

    async function validateDistance() {
        const address = document.getElementById('address').value;
    var proceedBtn = document.getElementById('proceedPaymentBtn');
        if (!address) return;

        // 1. Geocoding alamat ke koordinat (geocode.maps.co)
        const geoUrl = `https://geocode.maps.co/search?q=${encodeURIComponent(address)}`;
        const geoResp = await fetch(geoUrl);
        const geoData = await geoResp.json();
        if (!geoData[0] || !geoData[0].lat || !geoData[0].lon) {
            alert('Alamat tidak valid!\nPastikan alamat sudah benar atau pilih lokasi di peta.');
            proceedBtn.disabled = true;
            return;
        }
        const destLat = geoData[0].lat;
        const destLon = geoData[0].lon;

        // 2. Hitung jarak menggunakan OSRM (Open Source Routing Machine)
        // Format: http://router.project-osrm.org/route/v1/driving/{lon1},{lat1};{lon2},{lat2}?overview=false
        const osrmUrl = `https://router.project-osrm.org/route/v1/driving/${warehouseLon},${warehouseLat};${destLon},${destLat}?overview=false`;
        const osrmResp = await fetch(osrmUrl);
        const osrmData = await osrmResp.json();
        if (!osrmData.routes || !osrmData.routes[0]) {
            alert('Gagal menghitung jarak tempuh!');
            proceedBtn.disabled = true;
            return;
        }
        const distanceMeters = osrmData.routes[0].distance;
        const distanceKm = distanceMeters / 1000;

        if (distanceKm > 10) {
            alert('Alamat di luar jangkauan pengiriman (>10 km dari gudang). Checkout dinonaktifkan.');
            proceedBtn.disabled = true;
        } else {
            proceedBtn.disabled = false;
        }
    }
    // Panggil validateDistance saat field alamat berubah/blur
    if (document.getElementById('address')) {
        document.getElementById('address').addEventListener('blur', validateDistance);
    }
</script>
<script src="<?= base_url('assets/assets_dashboard/js/cart.js') ?>"></script>
<!-- Modal Konfirmasi Hapus Item -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus produk ini dari keranjang?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
let cartIdToDelete = null;
function removeItem(cartId) {
  cartIdToDelete = cartId;
  const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
  modal.show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
  if (!cartIdToDelete) return;
  // Lakukan AJAX hapus item
  fetch('<?= base_url('cart/deleteItem') ?>/' + cartIdToDelete, {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Reload halaman atau hapus baris item
      location.reload();
    } else {
      alert(data.message || 'Gagal menghapus item');
    }
  })
  .catch(error => {
    alert('Terjadi kesalahan saat menghapus item');
  });
  // Tutup modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
  modal.hide();
});
</script>
