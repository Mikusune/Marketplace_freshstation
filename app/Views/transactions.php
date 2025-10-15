<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Transaksi Midtrans</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard Transaksi Midtrans</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Order ID</th>
                <th>Gross Amount</th>
                <th>Status</th>
                <th>Payment Type</th>
                <th>Transaction Time</th>
                <th>Error</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction->order_id ?? 'N/A'; ?></td>
                        <td><?= isset($transaction->gross_amount) ? number_format($transaction->gross_amount, 2) : 'N/A'; ?></td>
                        <td><?= $transaction->transaction_status ?? 'N/A'; ?></td>
                        <td><?= $transaction->payment_type ?? 'N/A'; ?></td>
                        <td><?= $transaction->transaction_time ?? 'N/A'; ?></td>
                        <td><?= isset($transaction->error) ? $transaction->error : ''; ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#transactionModal" 
                                    data-order-id="<?= $transaction->order_id; ?>" 
                                    data-gross-amount="<?= number_format($transaction->gross_amount, 2); ?>" 
                                    data-status="<?= $transaction->transaction_status; ?>" 
                                    data-payment-type="<?= $transaction->payment_type; ?>" 
                                    data-transaction-time="<?= $transaction->transaction_time; ?>">
                                Detail
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
                <p><strong>Gross Amount:</strong> <span id="modalGrossAmount"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Payment Type:</strong> <span id="modalPaymentType"></span></p>
                <p><strong>Transaction Time:</strong> <span id="modalTransactionTime"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Script untuk mengisi data modal
        // Script untuk mengisi data modal
        $('#transactionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var orderId = button.data('order-id'); // Ambil data order-id
        var grossAmount = button.data('gross-amount'); // Ambil data gross amount
        var status = button.data('status'); // Ambil data status
        var paymentType = button.data('payment-type'); // Ambil data payment type
        var transactionTime = button.data('transaction-time'); // Ambil data transaction time

        // Isi data ke dalam modal
        var modal = $(this);
        modal.find('#modalOrderId').text(orderId);
        modal.find('#modalGrossAmount').text(grossAmount);
        modal.find('#modalStatus').text(status);
        modal.find('#modalPaymentType').text(paymentType);
        modal.find('#modalTransactionTime').text(transactionTime);
    });
</script>

</body>
</html>