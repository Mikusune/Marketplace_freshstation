<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manage Orders</h1>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <th>Shipping Status</th>
                                <th>Order Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $order->order_id ?></td>
                                    <td>
                                        <?= esc($order->username) ?><br>
                                        <small class="text-muted"><?= esc($order->email) ?></small>
                                    </td>
                                    <td>Rp<?= number_format($order->gross_amount, 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge badge-<?= getPaymentStatusColor($order->transaction_status) ?>">
                                            <?= ucfirst($order->transaction_status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= getShippingStatusColor($order->shipping_status ?? 'pending') ?>">
                                            <?= ucfirst($order->shipping_status ?? 'pending') ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($order->created_at)) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/orders/' . $order->id) ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No orders found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

function getShippingStatusColor($status) {
    switch ($status) {
        case 'delivered':
            return 'success';
        case 'shipped':
            return 'info';
        case 'processing':
            return 'primary';
        case 'pending':
            return 'warning';
        case 'cancelled':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>

<script>
$(document).ready(function() {
    $('#table-1').DataTable();
});
</script>
