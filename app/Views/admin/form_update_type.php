<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h1>Form Update Type ps</h1>
		</div>
	</div>

	<?php if (is_array($type)) : ?>
		<?php foreach ($type as $tp) : ?>
		<form method="POST" action="<?php echo base_url('admin/data_type/update_type_aksi') ?>">
			
			<div class="form-group">
				<label>Kode Type</label>
				<input type="hidden" name="id_type" value="<?php echo $tp['id_type'] ?>">
				<input type="text" name="kode_type" class="form-control" value="<?php echo $tp['kode_type'] ?>"> 
	        	<?php if (isset($validation) && $validation->hasError('kode_type')) : ?>
	        		<div class="text-small text-danger">
	        			<?= $validation->getError('kode_type') ?>
	        		</div>
	        	<?php endif; ?>
			</div>

			<div class="form-group">
				<label>Nama Type</label>
				<input type="text" name="nama_type" class="form-control" value="<?php echo $tp['nama_type'] ?>"> 
	        	<?php if (isset($validation) && $validation->hasError('nama_type')) : ?>
	        		<div class="text-small text-danger">
	        			<?= $validation->getError('nama_type') ?>
	        		</div>
	        	<?php endif; ?>
			</div>

			<button type="submit" class="btn btn-primary">
				Simpan
			</button>
			<button type="reset" class="btn btn-danger">
				Reset
			</button>

		</form>
		<?php endforeach; ?>
	<?php else : ?>
		<p>Data type tidak ditemukan.</p>
	<?php endif; ?>

</div>