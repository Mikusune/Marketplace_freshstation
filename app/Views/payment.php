<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-eQPe2gFThFqam1O-"></script>
</head>

<?php if (session()->get('debug')) : ?>
    <pre>
        <?= print_r(session()->get('debug'), true) ?>
    </pre>
<?php endif ?>
<body class="bg-light">
    <div class="bg-warning p-4">
        <div class="container">
            <nav class="text-sm text-muted">
                <a class="text-decoration-none text-dark" href="#">Home</a> /
                <a class="text-decoration-none text-dark" href="#">Pages</a> /
                <span>Cart</span>
            </nav>
            <h1 class="display-4 mt-2">Cart</h1>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 bg-white p-4 shadow-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">SUBTOTAL</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="https://placehold.co/100x100" alt="Product image of a dog food container" class="img-fluid" width="100" height="100">
                                <span class="ms-3">Product Name 1</span>
                            </td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </td>
                            <td>$150.00</td>
                            <td>
                                <button class="btn btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="https://placehold.co/100x100" alt="Product image of two bottles of juice" class="img-fluid" width="100" height="100">
                                <span class="ms-3">Product Name 2</span>
                            </td>
                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </td>
                            <td>$70.00</td>
                            <td>
                                <button class="btn btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 bg-white p-4 shadow-sm mt-4 mt-lg-0">
                <h2 class="h4">Cart Total</h2>
                <div class="mt-4">
                    <div class="d-flex justify-content-between border-top py-2">
                        <span>SUBTOTAL</span>
                        <span>$370.00</span>
                    </div>
                    <div class="d-flex justify-content-between border-top py-2">
                        <span>TOTAL</span>
                        <span>$370.00</span>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-dark w-100 mb-2">UPDATE CART</button>
                    <button class="btn btn-dark w-100 mb-2">CONTINUE SHOPPING</button>
                    <button class="btn btn-success w-100" id="pay-button">PROCEED TO CHECKOUT</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // document.getElementById('pay-button').onclick = function () {
    //     // Panggil API untuk mendapatkan snap token
    //     fetch('http://localhost:8080/create-transaction', { // Ganti dengan URL yang sesuai
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // Panggil Midtrans Snap
    //         snap.pay(data.snapToken, {
    //             onSuccess: function(result) {
    //                 // Tampilkan hasil sukses
    //                 alert('Payment Success! Transaction ID: ' + result.transaction_id);
    //                 console.log(result);
    //             },
    //             onPending: function(result) {
    //                 // Tampilkan hasil pending
    //                 alert('Waiting for your payment! Transaction ID: ' + result.transaction_id);
    //                 console.log(result);
    //             },
    //             onError: function(result) {
    //                 // Tampilkan hasil error
    //                 alert('Payment Failed! Transaction ID: ' + result.transaction_id);
    //                 console.log(result);
    //             }
    //         });
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         alert('Failed to get snap token.');
    //     });
    // };
    document.getElementById('pay-button').onclick = function () {
    // Panggil API untuk mendapatkan snap token
    fetch('http://localhost:8080/create-transaction', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            return Promise.reject(response);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.error);
            return;
        }
        
        // Tampilkan data transaksi sebelum melakukan checkout
        console.log('Data Transaksi:', data);
        console.log('Snap Token:', data.snapToken);
        
        // Tampilkan data di halaman (opsional)
        const dataContainer = document.getElementById('data-container');
        if (dataContainer) {
            dataContainer.innerHTML = `
                <h3>Data Transaksi:</h3>
                <pre>${JSON.stringify(data, null, 2)}</pre>
            `;
        }
        
        // Panggil Midtrans Snap
        snap.pay(data.snapToken, {
            onSuccess: function(result) {
                alert('Payment Success! Transaction ID: ' + result.transaction_id);
                console.log(result);
            },
            onPending: function(result) {
                alert('Waiting for your payment! Transaction ID: ' + result.transaction_id);
                console.log(result);
            },
            onError: function(result) {
                alert('Payment Failed! Transaction ID: ' + result.transaction_id);
                console.log(result);
            }
        });
    })
    .catch(error => {
        if (error.response) {
            error.response.text().then(text => {
                try {
                    const errorMessage = JSON.parse(text);
                    alert('Error: ' + errorMessage.error);
                    console.log('Error Response:', errorMessage);
                } catch (e) {
                    alert('Error: ' + text);
                    console.log('Error Response:', text);
                }
            });
        } else {
            console.error('Error:', error);
            alert('Failed to get snap token.');
        }
    });
};
</script>
</body>
</html>