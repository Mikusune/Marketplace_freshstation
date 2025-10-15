<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Input produk</h1>
        </div>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sukses!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= session()->getFlashdata('pesan') ?>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('admin/data_item') ?>" class="btn btn-primary">Kembali ke Menu Utama</a>
                <a href="<?= base_url('admin/data_item/tambah') ?>" class="btn btn-secondary">Tambah Item Lagi</a>
            </div>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= base_url('admin/data_item/simpan_item') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            

                            <div class="form-group">
                                <label>kategori</label>
                                <select name="kode_type" class="form-control" required>
                                    <option value="">-- Pilih Type --</option>
                                    <?php foreach ($types as $tp) : ?>
                                        <option value="<?= $tp['kode_type'] ?>"><?= $tp['nama_type'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>
                     

                            <div class="form-group">
                                <label>Berat / Volume</label>
                                <input type="text" name="berat" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>brand/merek</label>
                                <input type="text" name="brand" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Tidak Tersedia</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Harga Beli (Modal)</label>
                                <input type="number" name="harga_beli" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" required min="0">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            

                           
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar[]" class="form-control" multiple required onchange="previewImages()">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
function previewImages() {
    let preview = document.getElementById('imagePreview');
    preview.innerHTML = ""; // Bersihkan preview sebelumnya
    let files = document.querySelector('input[name="gambar[]"]').files;

    for (let i = 0; i < files.length; i++) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let img = document.createElement('img');
            img.src = e.target.result;
            img.width = 100;
            img.classList.add('mr-2', 'mb-2');
            preview.appendChild(img);
        };
        reader.readAsDataURL(files[i]);
    }
}

    $(document).ready(function() {
        <?php if (session()->getFlashdata('pesan')): ?>
            $('#successModal').modal('show');
        <?php endif; ?>
    });

</script>
