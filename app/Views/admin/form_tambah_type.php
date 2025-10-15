<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h1>Form Tambah Type ps</h1>
		</div>
	</div>

	<form method="POST" action="<?php echo base_url('admin/data_type/simpan_type') ?>" enctype="multipart/form-data">
		
		<div class="form-group">
			<label>Kode Type</label>
			<input type="text" name="kode_type" class="form-control"> 
        	<?php if (isset($validation) && $validation->hasError('kode_type')): ?>
                <div class="text-small text-danger">
                    <?php echo $validation->getError('kode_type'); ?>
                </div>
            <?php endif; ?>
		</div>

		<div class="form-group">
			<label>Nama Type</label>
			<input type="text" name="nama_type" class="form-control"> 
        	<?php if (isset($validation) && $validation->hasError('nama_type')): ?>
                <div class="text-small text-danger">
                    <?php echo $validation->getError('nama_type'); ?>
                </div>
            <?php endif; ?>
		</div>

		<div class="form-group">
			<label>Upload Gambar</label>
			<input type="file" name="gambar" class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">
			Simpan
		</button>
		<button type="reset" class="btn btn-danger">
			Reset
		</button>


	</form>

</div>