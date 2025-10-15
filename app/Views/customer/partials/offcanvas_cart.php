<div class="order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Your cart</span>
        <span class="badge bg-primary rounded-pill">
            <?= !empty($cartItems) ? count($cartItems) : 0 ?>
        </span>
    </h4>
    <?php if (!empty($cartItems)) : ?>
        <ul class="list-group mb-3">
            <?php foreach ($cartItems as $item) : ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0"><?= $item['nama_produk'] ?></h6>
                        <small class="text-body-secondary">Quantity: <?= $item['quantity'] ?></small>
                    </div>
                    <span class="text-body-secondary">Rp<?= number_format($item['harga'] * $item['quantity'], 2) ?></span>
                </li>
            <?php endforeach ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong>Rp<?= number_format($cartTotal ?? 0, 2) ?></strong>
            </li>
        </ul>
        <a href="<?= base_url('cart') ?>" class="w-100 btn btn-primary btn-lg">Continue to checkout</a>
    <?php else : ?>
        <div class="alert alert-info">
            Your cart is empty.
        </div>
    <?php endif ?>
</div>
