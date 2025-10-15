<?= $this->include('templates_customer/header'); ?>
<div class="container py-5">
    <h2 class="mb-4">Daftar Alamat Pengiriman</h2>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="showAddAddressForm()">+ Tambah Alamat Baru</button>
    </div>
    <div id="address-list">
        <?php if (!empty($addresses)): ?>
            <ul class="list-group mb-4">
                <?php foreach ($addresses as $addr): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div><strong><?= htmlspecialchars($addr['address']) ?></strong></div>
                            <div class="text-muted small">Lat: <?= $addr['latitude'] ?>, Lon: <?= $addr['longitude'] ?></div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2" onclick="editAddress(<?= $addr['id'] ?>, '<?= htmlspecialchars(addslashes($addr['address'])) ?>', <?= $addr['latitude'] ?>, <?= $addr['longitude'] ?>)">Edit</button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteAddress(<?= $addr['id'] ?>)">Hapus</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info">Belum ada alamat pengiriman.</div>
        <?php endif; ?>
    </div>
    <!-- Form Tambah/Edit Alamat -->
    <div id="address-form-section" style="display:none;">
        <h5 id="address-form-title">Tambah Alamat Baru</h5>
        <form id="address-form">
            <div class="mb-3">
                <label for="address-input" class="form-label">Alamat Lengkap</label>
                <textarea id="address-input" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Lokasi di Peta</label>
                <div id="map-address" style="height: 200px; border-radius:8px;"></div>
                <small class="text-muted">Klik pada peta untuk menentukan lokasi alamat.</small>
            </div>
            <input type="hidden" id="latitude-input">
            <input type="hidden" id="longitude-input">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="hideAddressForm()">Batal</button>
            </div>
        </form>
    </div>
    </div>
<?= $this->include('templates_customer/footer'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let editingId = null;
let mapAddress, markerAddress;
function showAddAddressForm() {
    editingId = null;
    document.getElementById('address-form-title').textContent = 'Tambah Alamat Baru';
    document.getElementById('address-input').value = '';
    document.getElementById('latitude-input').value = -6.249167;
    document.getElementById('longitude-input').value = 106.791778;
    document.getElementById('address-list').style.display = 'none';
    document.getElementById('address-form-section').style.display = 'block';
    setTimeout(initMapAddress, 200);
}
function editAddress(id, address, lat, lon) {
    editingId = id;
    document.getElementById('address-form-title').textContent = 'Edit Alamat';
    document.getElementById('address-input').value = address;
    document.getElementById('latitude-input').value = lat;
    document.getElementById('longitude-input').value = lon;
    document.getElementById('address-list').style.display = 'none';
    document.getElementById('address-form-section').style.display = 'block';
    setTimeout(() => initMapAddress(lat, lon), 200);
}
function hideAddressForm() {
    document.getElementById('address-form-section').style.display = 'none';
    document.getElementById('address-list').style.display = 'block';
}
function initMapAddress(lat = -6.249167, lon = 106.791778) {
    if (!mapAddress) {
        mapAddress = L.map('map-address').setView([lat, lon], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapAddress);
        markerAddress = L.marker([lat, lon], {draggable:true}).addTo(mapAddress);
        markerAddress.on('dragend', function(e) {
            const {lat, lng} = markerAddress.getLatLng();
            document.getElementById('latitude-input').value = lat;
            document.getElementById('longitude-input').value = lng;
        });
        mapAddress.on('click', function(e) {
            markerAddress.setLatLng(e.latlng);
            document.getElementById('latitude-input').value = e.latlng.lat;
            document.getElementById('longitude-input').value = e.latlng.lng;
        });
    } else {
        mapAddress.setView([lat, lon], 13);
        markerAddress.setLatLng([lat, lon]);
        mapAddress.invalidateSize();
    }
    document.getElementById('latitude-input').value = lat;
    document.getElementById('longitude-input').value = lon;
}
document.getElementById('address-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const address = document.getElementById('address-input').value;
    const latitude = document.getElementById('latitude-input').value;
    const longitude = document.getElementById('longitude-input').value;
    if (!address || !latitude || !longitude) {
        alert('Lengkapi alamat dan lokasi!');
        return;
    }
    const url = editingId ? '<?= base_url('customer/updateAddress') ?>' : '<?= base_url('customer/saveAddress') ?>';
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: JSON.stringify({
            id: editingId,
            address: address,
            latitude: latitude,
            longitude: longitude
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Gagal menyimpan alamat');
        }
    })
    .catch(() => alert('Gagal menyimpan alamat'));
});
function deleteAddress(id) {
    if (!confirm('Yakin ingin menghapus alamat ini?')) return;
    fetch('<?= base_url('customer/deleteAddress') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Gagal menghapus alamat');
        }
    })
    .catch(() => alert('Gagal menghapus alamat'));
}
</script>
