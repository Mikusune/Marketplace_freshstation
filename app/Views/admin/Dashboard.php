<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Produk</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_products ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Customer</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_customers ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pesanan</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_orders ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-check-double"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pesanan Selesai</h4>
                  </div>
                  <div class="card-body">
                    <?= $completed_orders ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Transaksi Terbaru</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Customer</th>
                          <th>Total</th>
                          <th>Status Pembayaran</th>
                          <th>Status Pengiriman</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                          <tr>
                            <td><?= $order->order_id ?></td>
                            <td><?= esc($order->username) ?></td>
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
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-center pt-1 pb-1">
                    <a href="<?= base_url('admin/orders') ?>" class="btn btn-primary btn-lg btn-round">
                      Lihat Semua Pesanan
                    </a>
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