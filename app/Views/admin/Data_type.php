<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kategori Produk</h1>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('pesan') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/data_type/tambah_type') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th width="20px">No</th>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
                                <th width="180px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($type as $tp) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $tp['kode_type'] ?></td>
                                    <td><?= $tp['nama_type'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="<?= base_url('admin/data_type/update_type/' . $tp['id_type']) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="confirmDelete(<?= $tp['id_type'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#table-1').DataTable();
});

function confirmDelete(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('admin/data_type/delete_type/'); ?>" + id;
        }
    });
}
</script>
