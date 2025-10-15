<div class="container py-5">
    <div class="mb-4">
        <a href="<?= base_url('customer/orders') ?>" class="text-decoration-none">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Detail Pesanan #<?= $order->order_id ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6>Informasi Pengiriman</h6>
                    <p class="mb-1"><strong>Alamat:</strong></p>
                    <p class="mb-3"><?= nl2br($order->shipping_address) ?></p>
                    <p class="mb-1"><strong>Kurir:</strong></p>
                    <p class="mb-3"><?= strtoupper($order->courier) ?> - Rp<?= number_format($order->shipping_cost, 0, ',', '.') ?></p>
                    <p class="mb-1"><strong>Status Pengiriman:</strong></p>
                    <p>
                        <?php
                        $shippingBadgeClass = match($order->shipping_status ?? 'pending') {
                            'delivered' => 'bg-success',
                            'shipped' => 'bg-info',
                            'processing' => 'bg-primary',
                            'cancelled' => 'bg-danger',
                            default => 'bg-warning text-dark'
                        };
                        ?>
                        <span class="badge <?= $shippingBadgeClass ?>">
                            <?= ucfirst($order->shipping_status ?? 'pending') ?>
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h6>Informasi Pembayaran</h6>
                    <p class="mb-1"><strong>Status:</strong></p>
                    <p>
                        <?php
                        $badgeClass = match($order->transaction_status) {
                            'settlement', 'capture' => 'bg-success',
                            'pending' => 'bg-warning text-dark',
                            'deny', 'cancel', 'expire' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        ?>
                        <span class="badge <?= $badgeClass ?>">
                            <?= ucfirst($order->transaction_status) ?>
                        </span>
                    </p>
                    <p class="mb-1"><strong>Metode Pembayaran:</strong></p>
                    <p class="mb-3"><?= $order->payment_type ? ucwords(str_replace('_', ' ', $order->payment_type)) : 'Belum dipilih' ?></p>
                    <p class="mb-1"><strong>Waktu Transaksi:</strong></p>
                    <p><?= date('d M Y H:i', strtotime($order->created_at)) ?></p>
                </div>
            </div>

            <h6 class="mb-3">Detail Item</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->items as $item): ?>
                            <tr>
                                <td><?= esc($item->nama_produk) ?></td>
                                <td>Rp<?= number_format($item->price, 0, ',', '.') ?></td>
                                <td><?= $item->quantity ?></td>
                                <td>Rp<?= number_format($item->price * $item->quantity, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Ongkos Kirim:</strong></td>
                            <td>Rp<?= number_format($order->shipping_cost, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rp<?= number_format($order->gross_amount, 0, ',', '.') ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <?php 
                helper('return');
                $return = get_return_by_order($order->id, user_id());
            ?>
            <?php if ($return): ?>
                <div class="alert alert-info mt-4 text-center">
                    <strong>Pengajuan Pengembalian:</strong> Status: <span class="badge badge-info" style="color: #000;"> <?= ucfirst($return['status']) ?> </span>
                    <?php if ($return['status'] == 'pending'): ?>
                        <br>Pengajuan Anda sedang diproses admin.
                    <?php elseif ($return['status'] == 'approved'): ?>
                        <br>Pengajuan Anda telah disetujui. Silakan cek notifikasi selanjutnya.
                    <?php elseif ($return['status'] == 'rejected'): ?>
                        <br>Pengajuan Anda ditolak. Silakan hubungi admin untuk info lebih lanjut.
                    <?php elseif ($return['status'] == 'completed'): ?>
                        <br>Pengembalian selesai diproses.
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <!-- Tombol Pengajuan Pengembalian Barang Rusak -->
                <div class="mt-4 text-end">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#returnModal">
                        Ajukan Pengembalian Barang Rusak
                    </button>
                </div>
            <?php endif; ?>

            <!-- Modal Form Pengajuan Pengembalian -->
            <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="<?= base_url('customer/returns/submit') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                      <h5 class="modal-title" id="returnModalLabel">Form Pengajuan Pengembalian Barang Rusak</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="order_id" value="<?= is_array($order) ? $order['id'] : ($order->id ?? '') ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Opsi Pengembalian</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="return_type" id="returnTypeReplace" value="replace" required>
                                                    <label class="form-check-label" for="returnTypeReplace">
                                                        Kirim produk kembali (penggantian barang)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="return_type" id="returnTypeRefund" value="refund" required>
                                                    <label class="form-check-label" for="returnTypeRefund">
                                                        Pengembalian dana
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="reason" class="form-label">Alasan Pengembalian</label>
                                                <textarea class="form-control" name="reason" id="reason" rows="3" required placeholder="Jelaskan kerusakan barang..."></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Foto Bukti Kerusakan</label>
                                                <input type="file" class="form-control" name="photo" id="photo" accept="image/*" required>
                                                <small class="text-muted">Format: jpg, jpeg, png. Maksimal 2MB.</small>
                                            </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Kirim Pengajuan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>