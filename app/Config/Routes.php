
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

// Admin routes with role filter
$routes->get('/Admin', 'Admin\Dashboard::index', ['filter' => 'role']);
$routes->get('/Admin/Dashboard', 'Admin\Dashboard::index', ['filter' => 'role']);

// Rute untuk Dataitem controller

$routes->get('customer/data_item', 'Customer\Data_item::index'); // Rute untuk menampilkan data item
$routes->get('customer/addresses', 'Customer\AddressController::index');
$routes->post('customer/saveAddress', 'Customer\AddressController::saveAddress');
$routes->post('customer/updateAddress', 'Customer\AddressController::updateAddress');
$routes->post('customer/deleteAddress/(:num)', 'Customer\AddressController::deleteAddress/$1');
$routes->get('customer/data_item/type/(:any)', 'Customer\Data_item::index/$1');
$routes->get('customer/data_item/detail_item/(:num)', 'Customer\Data_item::detail_item/$1'); // Rute untuk menampilkan detail item berdasarkan ID

$routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');
});

$routes->get('admin/logout', 'Admin\Dashboard::logout');

// Gabungkan semua route admin ke dalam satu group dengan filter login
$routes->group('admin', ['filter' => 'login'], function ($routes) {
    $routes->get('Dashboard', 'AdminController::dashboard');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('logout', 'Admin\Dashboard::logout');

    // Laporan Penjualan
    $routes->get('laporan/penjualan', 'Admin\LaporanController::penjualan');

    // Promo Routes
    $routes->get('promo', 'Admin\PromoController::index');
    $routes->get('promo/tambah', 'Admin\PromoController::tambah');
    $routes->post('promo/tambah_aksi', 'Admin\PromoController::tambah_aksi');
    $routes->get('promo/edit/(:num)', 'Admin\PromoController::edit/$1');
    $routes->post('promo/update', 'Admin\PromoController::update');
    $routes->get('promo/delete/(:num)', 'Admin\PromoController::delete/$1');

    // Admin Chat Routes
    $routes->get('chat', 'Admin\ChatController::index');
    $routes->get('chat/get_chat_list', 'Admin\ChatController::get_chat_list');
    $routes->get('chat/get_messages/(:num)', 'Admin\ChatController::get_messages/$1');
    $routes->get('chat/get_unread_count', 'Admin\ChatController::get_unread_count');
    $routes->post('chat/send_message', 'Admin\ChatController::send_message');

    // Routes untuk Data Item
    $routes->get('data_item', 'Admin\item::index'); // Menampilkan daftar item
    $routes->get('data_item/tambah_item', 'Admin\item::tambah_item'); // Form tambah item
    $routes->post('data_item/simpan_item', 'Admin\item::simpan_item'); // Proses simpan item
    $routes->get('data_item/detail_item/(:num)', 'Admin\item::detail_item/$1'); // Detail item berdasarkan ID
    $routes->get('data_item/update_item/(:num)', 'Admin\item::update_item/$1'); // Form edit item
    $routes->post('data_item/update_item/(:num)', 'Admin\item::update_item/$1'); // Proses update item
    $routes->post('data_item/update_item_aksi/(:num)', 'Admin\item::update_item_aksi/$1'); // Proses update item aksi
    $routes->post('data_item/update_item', 'Admin\item::update_item'); // Proses update item tanpa parameter
    $routes->get('data_item/delete_item/(:num)', 'Admin\item::delete_item/$1'); // Hapus item
    $routes->post('data_item/toggleFeatured/(:num)', 'item::toggleFeatured/$1'); // Toggle featured item

    // Routes untuk Kategori Produk
    $routes->get('data_type', 'Admin\TypeController::index'); // Menampilkan daftar kategori
    $routes->get('data_type/tambah_type', 'Admin\TypeController::tambah_type'); // Form tambah kategori
    $routes->post('data_type/simpan_type', 'Admin\TypeController::simpan_type'); // Proses simpan kategori
    $routes->get('data_type/update_type/(:num)', 'Admin\TypeController::update_type/$1'); // Form edit kategori
    $routes->post('data_type/update_type_aksi', 'Admin\TypeController::update_type_aksi'); // Proses update kategori
    $routes->get('data_type/delete_type/(:num)', 'Admin\TypeController::delete_type/$1'); // Hapus kategori

    // Routes untuk Produk Unggulan
    $routes->get('featured-products', 'Admin\FeaturedProductController::index');
    $routes->post('featured-products/toggle/(:num)', 'Admin\FeaturedProductController::toggle/$1');

    // Admin Shipping Config
    $routes->get('shipping', 'Admin\ShippingController::index');
    $routes->post('shipping/update', 'Admin\ShippingController::update');

    // Pengajuan Pengembalian
    $routes->get('returns', 'Admin\ReturnController::index');
    $routes->get('returns/detail/(:num)', 'Admin\ReturnController::detail/$1');
    $routes->post('returns/update_status/(:num)', 'Admin\ReturnController::update_status/$1');
    $routes->post('returns/refund/(:num)', 'Admin\ReturnController::refund/$1');
});

// Admin Order Routes
$routes->group('admin/orders', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'Admin\OrderController::index');
    $routes->get('(:num)', 'Admin\OrderController::detail/$1');
    $routes->post('(:num)/status', 'Admin\OrderController::updateStatus/$1');
});

$routes->get('payment', 'PaymentController::index'); // Route untuk menampilkan view pembayaran
$routes->post('create-transaction', 'PaymentController::createTransaction'); // Route untuk membuat transaksi
$routes->post('payment/updateStockAfterPayment', 'PaymentController::updateStockAfterPayment'); // Route untuk update stok setelah pembayaran
$routes->post('customer/getOngkir', 'Customer\ShippingController::getOngkir'); // Route untuk mendapatkan ongkir
$routes->get('transactions', 'AdminController::transactions'); // Route untuk dashboard transaksi

// Route untuk cart dan profile dengan filter login
$routes->group('', ['filter' => 'login'], function($routes) {
    $routes->get('/cart', 'Customer\CartController::viewCart');
    $routes->get('/cart/view', 'Customer\CartController::viewCartAjax'); // <--- Tambahkan ini
    $routes->post('/cart/add/(:num)', 'Customer\CartController::addToCart/$1');
    $routes->post('/cart/update/(:num)', 'Customer\CartController::updateQuantity/$1');
    $routes->post('/cart/delete/(:num)', 'Customer\CartController::deleteItem/$1');
    $routes->post('payment/createTransaction', 'PaymentController::createTransaction');
    $routes->get('/profile', 'Customer\ProfileController::index');
    $routes->post('/profile/update', 'Customer\ProfileController::update');
});

// Route untuk products
$routes->get('/products', 'Customer\ProductController::index');
$routes->get('products/search', 'ProductController::search');

$routes->group('customer', function($routes) {
    $routes->get('orders', 'Customer\OrderController::index');
    $routes->get('orders/(:num)', 'Customer\OrderController::detail/$1');
    // Pengajuan pengembalian customer
    $routes->post('returns/submit', 'Customer\ReturnController::submit');
});

// Customer Chat Routes
$routes->group('customer/chat', ['filter' => 'login'], function($routes) {
    $routes->post('send_message', 'Customer\ChatController::send_message');
    $routes->get('get_messages', 'Customer\ChatController::get_messages');
    $routes->get('get_unread_count', 'Customer\ChatController::get_unread_count');
});

// Pages
$routes->get('pages/about', 'Pages::about');
$routes->get('pages/faq', 'Pages::faq');
$routes->get('pages/contact', 'Pages::contact');
// 

// Auth Routes
$routes->get('pages/about', 'Pages::about');
// Admin Shipping Config


// Penutup group dan file