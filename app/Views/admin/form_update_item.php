<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Update Produk</h1>
        </div>

        <div class="card">
            <div class="card-body">

                <?php if (is_array($produk)) : ?>
                    <?php foreach ($produk as $tp) : ?>
                        <form method="POST" action="<?= base_url('admin/data_item/update_item_aksi/' . $tp['id_item']) ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Kategori Produk</label>
                                <input type="hidden" name="id_produk" value="<?php echo $tp['id_item'] ?>">
                                <select name="kode_type" class="form-control" required>
                                    <?php foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt['kode_type'] ?>" <?= ($kt['kode_type'] == $tp['kode_type']) ? 'selected' : '' ?>>
                                            <?= $kt['nama_type'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" value="<?php echo $tp['nama_produk'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Berat / Volume</label>
                                <input type="text" name="berat" class="form-control" value="<?php echo $tp['berat'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Brand/Merek</label>
                                <input type="text" name="brand" class="form-control" value="<?php echo $tp['brand'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" <?php echo $tp['status'] == 1 ? 'selected' : '' ?>>Tersedia</option>
                                    <option value="0" <?php echo $tp['status'] == 0 ? 'selected' : '' ?>>Tidak Tersedia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Beli (Modal)</label>
                                <input type="number" name="harga_beli" class="form-control" value="<?php echo $tp['harga_beli'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" value="<?php echo $tp['harga_jual'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" value="<?php echo $tp['stok'] ?>" required min="0">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required><?php echo $tp['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar[]" class="form-control" multiple onchange="previewImages()">
                                <div class="mt-2">
                                    <label>Gambar Saat Ini:</label>
                                    <div id="existingImages" class="mt-2">
                                        <?php 
                                        $existing_images = explode(',', $tp['gambar']);
                                        foreach($existing_images as $img): 
                                            if(!empty($img)):
                                        ?>
                                            <img src="<?= base_url('assets/upload/' . trim($img)) ?>" width="100" class="mr-2 mb-2">
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </div>
                                </div>
                                <div id="imagePreview" class="mt-2">
                                    <label>Preview Gambar Baru:</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Data produk tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<script>
    function previewImages() {
        let preview = document.getElementById('imagePreview');
        preview.innerHTML = "<label>Preview Gambar Baru:</label>"; // Reset preview but keep the label
        let files = document.querySelector('input[name="gambar[]"]').files;

        for (let i = 0; i < files.length; i++) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.width = 100;
                img.classList.add('mr-2', 'mb-2');
                preview.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    }

    // Menghapus event listener yang lama
    document.querySelector('form').addEventListener('submit', function(event) {
        // Biarkan form melakukan submit normal tanpa preventDefault
        // Form akan di-handle oleh controller dan melakukan redirect
    });
</script>