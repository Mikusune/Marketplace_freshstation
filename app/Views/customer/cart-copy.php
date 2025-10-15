<div class="container d-flex flex-column flex-sm-row align-items-sm-center justify-content-between position-relative">
    <nav class="mb-3 mb-sm-0">
        <ul class="list-unstyled d-flex flex-wrap gap-2 mb-0 small text-secondary">
            <li>Home</li>
            <li>/</li>
            <li>Pages</li>
            <li>/</li>
            <li>Cart</li>
        </ul>
    </nav>
    <h1 class="mb-0">Cart</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<main class="container py-5 d-flex flex-column flex-lg-row gap-4">
    <section class="flex-grow-1">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="w-50">Product</th>
                    <th scope="col" class="text-center w-25">Quantity</th>
                    <th scope="col" class="text-end w-25">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr data-cart-id="<?= $item['id'] ?>">
                        <td class="d-flex align-items-center gap-3">
                            <img alt="<?= $item['nama_produk'] ?>" class="img-fluid" height="60" src="<?= base_url('assets/upload/' . $item['gambar']) ?>" width="60"/>
                            <span class="product-name"><?= $item['nama_produk'] ?></span>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-inline-flex align-items-center gap-1">
                                <button aria-label="Decrease quantity" class="quantity-btn" type="button" onclick="updateQuantity('<?= $item['id'] ?>', 'decrease')">−</button>
                                <input class="quantity-input" readonly="" type="text" value="<?= $item['quantity'] ?>" id="quantity-<?= $item['id'] ?>">
                                <button aria-label="Increase quantity" class="quantity-btn" type="button" onclick="updateQuantity('<?= $item['id'] ?>', 'increase')">+</button>
                            </div>
                        </td>
                        <td class="text-end align-middle d-flex justify-content-end align-items-center gap-3">
                            <span class="subtotal-text" data-subtotal-id="<?= $item['id'] ?>">Rp<?= number_format($item['harga'] * $item['quantity'], 2) ?></span>
                            <button aria-label="Remove product" class="btn-trash" type="button" onclick="removeItem('<?= $item['id'] ?>')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>

    <aside class="w-100 w-lg-auto cart-aside">
        <h2 class="cart-total-title">Cart Total</h2>
        <div class="cart-total-box">
            <?php
            $cartTotal = 0;
            foreach ($cartItems as $item) :
                $subtotal = $item['harga'] * $item['quantity'];
                $cartTotal += $subtotal;
            endforeach;
            ?>
            <div>
                <span>Subtotal</span>
                <span class="cart-total-amount">Rp<?= number_format($cartTotal, 2) ?></span>
            </div>
        </div>
        <div class="d-flex gap-3 mb-3">
            <button class="btn-continue w-100" type="button" onclick="continueShopping()">Continue Shopping</button>
        </div>
        <button class="btn-checkout" id="pay-button" type="button">Proceed to Checkout</button>
    </aside>
</main>

<!-- Shipping Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Shipping Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="shipping-form">
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter your complete shipping address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="courier" class="form-label">Select Courier</label>
                        <select id="courier" name="courier" class="form-select" required>
                            <option value="">Choose courier...</option>
                            <option value="jne">JNE Regular (Rp20,000)</option>
                            <option value="pos">POS Indonesia (Rp15,000)</option>
                            <option value="tiki">TIKI (Rp18,000)</option>
                        </select>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Order Summary</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>Rp<?= number_format($cartTotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping Cost:</span>
                                <span id="modal-shipping-cost">Rp0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span id="modal-total-cost">Rp<?= number_format($cartTotal, 2) ?></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="proceedToPayment()">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>

<script>
    const csrf_token = '<?= csrf_token() ?>';
    const csrf_hash = '<?= csrf_hash() ?>';
    
    document.getElementById('pay-button').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('shippingModal'));
        modal.show();
    });

    document.getElementById('courier').addEventListener('change', function() {
        const courier = this.value;
        let shippingCost = 0;

        switch(courier) {
            case 'jne':
                shippingCost = 20000;
                break;
            case 'pos':
                shippingCost = 15000;
                break;
            case 'tiki':
                shippingCost = 18000;
                break;
        }

        const cartTotal = <?= $cartTotal ?>;
        const totalCost = cartTotal + shippingCost;

        document.getElementById('modal-shipping-cost').textContent = `Rp${shippingCost.toLocaleString()}`;
        document.getElementById('modal-total-cost').textContent = `Rp${totalCost.toLocaleString()}`;
    });

    function proceedToPayment() {
        const address = document.getElementById('address').value;
        const courier = document.getElementById('courier').value;

        if (!address || !courier) {
            alert('Please fill in all shipping information');
            return;
        }

        const shippingCost = courier === 'jne' ? 20000 : (courier === 'pos' ? 15000 : 18000);
        const totalCost = <?= $cartTotal ?> + shippingCost;

        // Send data to Midtrans API
        fetch('<?= base_url("payment/createTransaction") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_hash
            },
            body: JSON.stringify({
                address: address,
                courier: courier,
                shipping_cost: shippingCost,
                total_amount: totalCost,
                items: <?= json_encode($cartItems) ?>
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snapToken) {
                window.snap.pay(data.snapToken);
            } else {
                alert('Failed to create transaction.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your payment.');
        });
    }
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>
<script src="<?= base_url('assets/assets_dashboard/js/cart.js') ?>"></script>
