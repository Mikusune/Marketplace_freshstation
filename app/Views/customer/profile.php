<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <div class="position-relative mb-4">
                        <img src="https://ui-avatars.com/api/?name=<?= esc($user->username) ?>&background=random" 
                             alt="avatar" class="rounded-circle img-fluid shadow" style="width: 150px;">
                    </div>
                    <h4 class="mb-3 fw-bold"><?= esc($user->username) ?></h4>
                    <p class="text-muted mb-3">
                        <span class="badge bg-<?= $is_admin ? 'primary' : 'success' ?> px-3 py-2">
                            <?= $is_admin ? 'Admin' : 'Pelanggan' ?>
                        </span>
                    </p>
                    <?php if ($is_admin): ?>
                        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary mt-2 shadow-sm w-100">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0 ps-3">
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('profile/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label class="form-label fw-semibold">Nama Pengguna</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" value="<?= esc($user->username) ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="fullname" class="form-control" value="<?= old('fullname', esc($user->fullname)) ?>" placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label class="form-label fw-semibold">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" value="<?= old('email', esc($user->email)) ?>" placeholder="Masukkan alamat email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>Perbarui Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
