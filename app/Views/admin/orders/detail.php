<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Order Detail #<?= $order->order_id ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('admin/orders') ?>">Orders</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>×</span></button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>×</span></button>
                    <?= session()->getFlashdata('error') ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Items</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item): ?>
                                        <tr>
                                            <td><?= esc($item->nama_produk) ?></td>
                                            <td><?= $item->quantity ?></td>
                                            <td>Rp<?= number_format($item->price, 0, ',', '.') ?></td>
                                            <td>Rp<?= number_format($item->price * $item->quantity, 0, ',', '.') ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Shipping Cost:</strong></td>
                                            <td>Rp<?= number_format($order->shipping_cost, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                            <td><strong>Rp<?= number_format($order->gross_amount, 0, ',', '.') ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="profile-widget-description">
                                <div class="profile-widget-name mb-3">
                                    <?= esc($order->username) ?> 
                                    <div class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> Customer
                                    </div>
                                </div>
                                <p><i class="fas fa-envelope mr-1"></i> <?= esc($order->email) ?></p>
                                <p class="mb-0"><i class="fas fa-map-marker-alt mr-1"></i> Shipping Address:</p>
                                <p class="pl-4 mb-0"><?= nl2br(esc($order->shipping_address)) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Order Status</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/orders/' . $order->id . '/status') ?>" method="POST">
                                <?= csrf_field() ?>
                                
                                <div class="form-group">
                                    <label>Payment Status</label>
                                    <div class="badges">
                                        <span class="badge badge-<?= getPaymentStatusColor($order->transaction_status) ?>">
                                            <?= ucfirst($order->transaction_status) ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="shipping_status">Shipping Status</label>
                                    <select class="form-control" id="shipping_status" name="status">
                                        <?php
                                        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                                        foreach ($statuses as $status):
                                        ?>
                                        <option value="<?= $status ?>" <?= $order->shipping_status === $status ? 'selected' : '' ?>>
                                            <?= ucfirst($status) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                            </form>

                            <hr>

                            <div class="form-group">
                                <label>Order Date</label>
                                <p class="mb-0"><i class="fas fa-calendar-alt mr-1"></i> <?= date('d M Y H:i', strtotime($order->created_at)) ?></p>
                            </div>

                            <div class="form-group">
                                <label>Payment Method</label>
                                <p class="mb-0"><i class="fas fa-credit-card mr-1"></i> <?= ucwords(str_replace('_', ' ', $order->payment_type ?? 'Not specified')) ?></p>
                            </div>

                            <?php if ($order->courier): ?>
                            <div class="form-group mb-0">
                                <label>Courier</label>
                                <p class="mb-0"><i class="fas fa-truck mr-1"></i> <?= strtoupper($order->courier) ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
function getPaymentStatusColor($status) {
    switch ($status) {
        case 'settlement':
            return 'success';
        case 'pending':
            return 'warning';
        case 'cancel':
        case 'expire':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>
