<div class="container py-5">
    <h2 class="mb-4">Daftar Pesanan</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info">
            Belum ada pesanan. <a href="<?= base_url('products') ?>">Mulai berbelanja</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($orders as $order): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #<?= $order->order_id ?></h5>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <p class="mb-1"><strong>Total:</strong></p>
                                    <p>Rp<?= number_format($order->gross_amount, 0, ',', '.') ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Status Pembayaran:</strong></p>
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
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <p class="mb-1"><strong>Tanggal:</strong></p>
                                    <p><?= date('d M Y H:i', strtotime($order->created_at)) ?></p>
                                </div>
                                <div class="col-6">
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
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p class="mb-1"><strong>Kurir:</strong></p>
                                    <p class="mb-0"><?= strtoupper($order->courier) ?></p>
                                </div>
                            </div>
                            
                            <a href="<?= base_url('customer/orders/' . $order->id) ?>" class="btn btn-primary">
                                Lihat Detail
                            </a>
                            <?php 
                                helper('return');
                                $return = get_return_by_order($order->id, user_id());
                            ?>
                            <?php if ($return): ?>
                                <span class="badge badge-warning mb-2" style="color: #000;">Pengembalian: <?= ucfirst($return['status']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>