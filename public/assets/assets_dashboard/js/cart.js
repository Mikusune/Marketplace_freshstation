function formatRupiah(amount) {
    return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
        .replace('IDR', 'Rp')
        .replace(',00', '');
}

function updateQuantity(cartId, action) {
    const quantityInput = document.getElementById('quantity-' + cartId);
    const currentQuantity = parseInt(quantityInput.value);
    let newQuantity = action === 'increase' ? currentQuantity + 1 : currentQuantity - 1;
    
    if (newQuantity < 1) {
        return;
    }

    quantityInput.value = newQuantity;

    const formData = new FormData();
    formData.append('quantity', newQuantity);
    formData.append(csrf_token, csrf_hash);

    fetch('/cart/update/' + cartId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update item subtotal
            const subtotalElement = document.querySelector(`[data-subtotal-id="${cartId}"]`);
            if (subtotalElement) {
                subtotalElement.textContent = formatRupiah(data.itemSubtotal);
            }

            // Update cart total
            const cartTotalElement = document.querySelector('.cart-total-amount');
            if (cartTotalElement) {
                cartTotalElement.textContent = formatRupiah(data.cartTotal);
            }

            // Update modal totals if they exist
            const modalSubtotalElement = document.querySelector('#modal-total-cost');
            if (modalSubtotalElement) {
                modalSubtotalElement.textContent = formatRupiah(data.cartTotal);
            }
        } else {
            alert(data.message || 'Failed to update quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update quantity');
    });
}

function removeItem(cartId) {
    if (!confirm('Are you sure you want to remove this item?')) {
        return;
    }

    fetch('/cart/delete/' + cartId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrf_hash
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the item row
            const itemRow = document.querySelector(`[data-cart-id="${cartId}"]`);
            if (itemRow) {
                itemRow.remove();
            }

            // Update cart total
            const cartTotalElement = document.querySelector('.cart-total-amount');
            if (cartTotalElement) {
                cartTotalElement.textContent = formatRupiah(data.cartTotal);
            }

            // Update modal totals if they exist
            const modalSubtotalElement = document.querySelector('#modal-total-cost');
            if (modalSubtotalElement) {
                modalSubtotalElement.textContent = formatRupiah(data.cartTotal);
            }

            // If cart is empty, disable checkout button
            if (data.itemCount === 0) {
                const checkoutButton = document.getElementById('pay-button');
                if (checkoutButton) {
                    checkoutButton.disabled = true;
                }
            }
        } else {
            alert(data.message || 'Failed to remove item');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to remove item');
    });
}

function continueShopping() {
    window.location.href = '/products';
}
