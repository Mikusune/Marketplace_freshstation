<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* Fix header overlap */
/* .container.px-0 {
  margin-top: 60px; 
} */

/* Reset z-index stacking context */
/* .dashboard-container {
  position: relative;
  z-index: auto;
} */

/* Ensure sections don't create new stacking contexts unnecessarily */
/* section {
  position: relative;
  z-index: auto;
} */

/* Fixed header positioning */
/* header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1030; 
} */

/* Dropdown menus */
/* .dropdown-menu {
  z-index: 1031 !important; 
} */

/* Main content spacing */
/* .main-content {
  margin-top: 80px;
  position: relative;
  z-index: 1;
} */

/* Hero Carousel positioning */
#dashboardHeroCarousel {
  position: relative;
  z-index: 1;
}

/* Dashboard Styles */
/* .dashboard-container {
  position: relative;
} */

.dashboard-content {
  position: relative;
}

/* Panel dan card di dashboard */
.dashboard-panel {
  position: relative;
}

/* Sidebar jika ada */
.dashboard-sidebar {
  position: relative;
  z-index: 3;
}

/* Offcanvas dan modals */
.offcanvas,
.modal {
  z-index: 1045 !important;
}

/* Backdrop fix */
.offcanvas-backdrop,
.modal-backdrop {
  z-index: 1040 !important;
}

/* Kategori Card Styles */
.category-card {
  transition: transform 0.3s ease;
  position: relative;
  z-index: 1;
  cursor: pointer;
  height: 100%;
}

.category-card:hover {
  transform: translateY(-5px);
  z-index: 2;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.category-card .card-body {
  padding: 1.5rem;
}

.category-card .card-body {
  padding: 1.5rem;
  height: 250px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.category-card img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  padding: 5px;
  background: #fff;
  transition: all 0.3s ease;
  margin: 0 auto;
}

.category-card:hover img {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Product Card Styles */
.product-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
}

.product-card img {
  height: 200px;
  object-fit: cover;
}

/* Feature Icon Styles */
.feature-icon {
  transition: transform 0.3s ease;
}

.feature-icon:hover {
  transform: scale(1.1);
}

/* Testimonial Card Styles */
.testimonial-card {
  transition: transform 0.3s ease;
}

.testimonial-card:hover {
  transform: translateY(-5px);
}

/* Promo Card Styles */
.promo-card {
  overflow: hidden;
}

.promo-card img {
  transition: transform 0.3s ease;
}

.promo-card:hover img {
  transform: scale(1.05);
}

/* Carousel styles */
.carousel {
  position: relative;
  z-index: 1;
  overflow: hidden;
  margin-bottom: 30px;
  width: 100%;
  max-width: 1280px; /* Menambahkan max-width sesuai ukuran gambar */
  margin-left: auto;
  margin-right: auto;
}

.carousel-inner {
  position: relative;
  width: 100%;
  height: auto;
  aspect-ratio: 1280/483;
  background-color: #f8f9fa;
}

.carousel-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  visibility: hidden;
  transition: all 0.6s ease-in-out;
  display: flex;
  align-items: center;
  justify-content: center;
}

.carousel-item.active {
  position: relative;
  opacity: 1;
  visibility: visible;
  transform: translateX(0);
}

.carousel-item img {
  width: auto; /* Mengubah dari 100% ke auto */
  height: 100%;
  max-width: 100%;
  object-fit: contain;
  display: block;
}

/* Animasi slide horizontal */
.carousel-item-next:not(.carousel-item-start),
.active.carousel-item-end {
  transform: translateX(100%);
  opacity: 0;
  visibility: hidden;
}

.carousel-item-prev:not(.carousel-item-end),
.active.carousel-item-start {
  transform: translateX(-100%);
  opacity: 0;
  visibility: hidden;
}

.carousel-item-next.carousel-item-start,
.carousel-item-prev.carousel-item-end {
  transform: translateX(0);
  opacity: 1;
  visibility: visible;
}



/* Responsive adjustments */
@media (max-width: 992px) {
  .carousel-inner {
    aspect-ratio: 1280/483;
  }
  .carousel-item img {
    object-fit: contain;
  }
}

@media (max-width: 768px) {
  .carousel-inner {
    aspect-ratio: 4/3;
  }
  .carousel-item img {
    object-fit: contain;
  }
}

@media (max-width: 576px) {
  .carousel-inner {
    aspect-ratio: 1/1;
  }
  
  .carousel-item img {
    object-fit: contain;
  }
  
  /* Menyesuaikan posisi controls */
  .carousel-control-prev,
  .carousel-control-next {
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
  }
  
  .carousel-control-prev {
    left: 10px;
  }
  
  .carousel-control-next {
    right: 10px;
  }
}

/* Live Chat Button Styles */
.live-chat-btn {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #28a745;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
  z-index: 1050;
}

.live-chat-btn:hover {
  transform: scale(1.1);
  background-color: #218838;
}

/* Chat Modal Styles */
.chat-modal {
  position: fixed;
  bottom: 100px;
  right: 30px;
  width: 350px;
  height: 500px;
  background: white;
  border-radius: 15px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.2);
  display: none;
  z-index: 1051;
}

.chat-header {
  background: #28a745;
  color: white;
  padding: 15px;
  border-radius: 15px 15px 0 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.chat-messages {
  height: 370px;
  padding: 15px;
  overflow-y: auto;
}

.chat-input-area {
  padding: 15px;
  border-top: 1px solid #eee;
  display: flex;
  gap: 10px;
}

.message {
  margin-bottom: 10px;
  max-width: 80%;
}

.message.customer {
  margin-left: auto;
  background: #28a745;
  color: white;
  padding: 10px 15px;
  border-radius: 15px 15px 0 15px;
}

.message.admin {
  margin-right: auto;
  background: #f1f1f1;
  padding: 10px 15px;
  border-radius: 15px 15px 15px 0;
}

/* Hover Card Styles */
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
}

.hover-card img {
    transition: all 0.3s ease;
}

.hover-card:hover img {
    transform: scale(1.05);
}
</style>

<!-- Hero Carousel -->
<div class="container px-0" data-aos="fade-in">  <!-- Mengubah dari container-fluid ke container -->
  <div id="dashboardHeroCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in" data-aos-duration="1000">
    <div class="carousel-indicators" data-aos="fade-up" data-aos-delay="200">
      <button type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner" data-aos="fade-up" data-aos-delay="100">
      <div class="carousel-item active" data-aos="zoom-in" data-aos-delay="300">
        <img src="<?= base_url('assets/assets_dashboard/images/banner-1.png') ?>" class="d-block w-100" alt="Banner 1">
      </div>
      <div class="carousel-item">
        <img src="<?= base_url('assets/assets_dashboard/images/banner-2.png') ?>" class="d-block w-100" alt="Banner 2">
      </div>
      <div class="carousel-item">
        <img src="<?= base_url('assets/assets_dashboard/images/banner-3.png') ?>" class="d-block w-100" alt="Banner 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide="prev" data-aos="fade-right" data-aos-delay="400">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide="next" data-aos="fade-left" data-aos-delay="400">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<!-- Features Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <div class="text-success mb-3">
              <i class="fas fa-leaf fa-3x"></i>
            </div>
            <h4>100% Organik</h4>
            <p class="text-muted">Produk organik berkualitas tinggi yang dipilih langsung dari petani terpercaya.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <div class="text-success mb-3">
              <i class="fas fa-truck fa-3x"></i>
            </div>
            <h4>Gratis Ongkir</h4>
            <p class="text-muted">Gratis pengiriman untuk setiap pembelian di atas Rp 200.000.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <div class="text-success mb-3">
              <i class="fas fa-award fa-3x"></i>
            </div>
            <h4>Kualitas Terjamin</h4>
            <p class="text-muted">Jaminan kualitas terbaik atau uang kembali 100%.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kategori Populer -->
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <h2>Kategori Populer</h2>
      <a href="<?= base_url('products') ?>" class="btn btn-outline-success">Lihat Semua</a>
    </div>
    <div class="row g-4">
      <?php 
      $counter = 0;
      foreach ($categories as $category) : 
        if ($counter >= 6) break; // Limit to 6 categories
      ?>
        <div class="col-lg-2 col-md-4 col-6" data-aos="fade-up" data-aos-delay="<?= $counter * 100 ?>">
          <a href="<?= base_url('products?type=' . $category['kode_type']) ?>" class="text-decoration-none">
            <div class="card border-0 text-center category-card">
              <div class="card-body">
                <?php if (!empty($category['img'])) : ?>
                  <img src="<?= base_url('assets/uploads/' . $category['img']) ?>" alt="<?= $category['nama_type'] ?>" class="mb-3" style="width: 80px; height: 80px; object-fit: contain;">
                <?php else : ?>
                  <div class="bg-light rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="fas fa-box fa-2x text-success"></i>
                  </div>
                <?php endif; ?>
                <h5 class="card-title text-dark"><?= $category['nama_type'] ?></h5>
                <p class="text-muted mb-0"><?= $category['jumlah'] ?? 0 ?> Produk</p>
              </div>
            </div>
          </a>
        </div>
      <?php 
        $counter++;
      endforeach; 
      ?>
    </div>
  </div>
</section>

<!-- Promo & Diskon -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <h2>Promo Spesial Hari Ini</h2>
      <a href="<?= base_url('products') ?>" class="btn btn-outline-success">Lihat Semua</a>
    </div>
    <?php if (!empty($promos)) : ?>
      <div class="row g-4">
        <?php 
        $counter = 0;
        foreach ($promos as $promo) : 
          if ($counter >= 3) break; // Limit to 3 promos
          $discounted_price = $promo['original_price'] - ($promo['original_price'] * $promo['discount_percentage'] / 100);
        ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $counter * 100 ?>">
            <a href="<?= base_url('customer/data_item/detail_item/' . $promo['id_item']) ?>" 
               class="text-decoration-none">
              <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="position-relative">
                  <img src="<?= base_url('assets/upload/' . $promo['gambar']) ?>" 
                       class="card-img-top" alt="<?= $promo['nama_produk'] ?>"
                       style="height: 200px; object-fit: cover;">
                  <div class="position-absolute top-0 end-0 bg-danger text-white px-3 py-2 rounded-start">
                    <?= $promo['discount_percentage'] ?>% OFF
                  </div>
                  <!-- Countdown Timer -->
                  <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-75 text-white p-2">
                    <small class="d-block text-center">Berakhir dalam:</small>
                    <div class="countdown-timer text-center" data-end="<?= $promo['end_date'] ?>">
                      <span class="days">00</span>h 
                      <span class="hours">00</span>j
                      <span class="minutes">00</span>m 
                      <span class="seconds">00</span>d
                    </div>
                  </div>
                  <?php if ($promo['stok'] <= 0): ?>
                    <div class="position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                         style="background: rgba(0,0,0,0.5);">
                      <h5 class="text-white mb-0">Stok Habis</h5>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="card-body">
                  <h5 class="card-title text-dark"><?= $promo['nama_produk'] ?></h5>
                  <p class="card-text text-muted"><?= $promo['nama_type'] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <p class="text-decoration-line-through text-muted mb-0">
                        Rp <?= number_format($promo['original_price'], 0, ',', '.') ?>
                      </p>
                      <p class="text-danger fs-5 fw-bold mb-0">
                        Rp <?= number_format($discounted_price, 0, ',', '.') ?>
                      </p>
                    </div>
                  </div>
                  <?php if ($promo['stok'] > 0): ?>
                    <small class="text-success d-block mt-2">
                      <i class="fas fa-check-circle"></i> Stok tersedia (<?= $promo['stok'] ?>)
                    </small>
                  <?php endif; ?>
                </div>
              </div>
            </a>
          </div>
        <?php 
          $counter++;
        endforeach; 
        ?>
      </div>
    <?php else: ?>
      <div class="text-center text-muted">
        <p>Belum ada promo yang tersedia saat ini.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Produk Unggulan -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-4" data-aos="fade-up">Produk Unggulan</h2>
    <div class="row g-4">
      <?php if (!empty($item)) : ?>
        <?php $counter = 0; ?>
        <?php foreach ($item as $product) : ?>
          <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="<?= $counter * 100 ?>">
            <div class="card border-0 shadow-sm product-card h-100">
              <div class="position-relative">
                <img src="<?= base_url('assets/upload/' . $product['gambar']) ?>" 
                     class="card-img-top" 
                     alt="<?= $product['nama_produk'] ?>"
                     style="height: 200px; object-fit: cover;">
                <?php if (isset($product['discount_percentage']) && $product['discount_percentage'] > 0) : ?>
                  <div class="badge bg-danger position-absolute top-0 end-0 m-2">
                    <?= $product['discount_percentage'] ?>% OFF
                  </div>
                <?php endif; ?>
                <?php if ($product['stok'] <= 0): ?>
                  <div class="position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                       style="background: rgba(0,0,0,0.5);">
                    <h5 class="text-white mb-0">Stok Habis</h5>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <a href="<?= base_url('customer/data_item/detail_item/' . $product['id_item']) ?>" 
                   class="text-decoration-none">
                  <h5 class="card-title text-dark"><?= $product['nama_produk'] ?></h5>
                  <p class="card-text text-muted"><?= $product['nama_type'] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <?php if (isset($product['discount_percentage']) && $product['discount_percentage'] > 0) : ?>
                      <?php
                        $discounted_price = $product['harga_jual'] - ($product['harga_jual'] * $product['discount_percentage'] / 100);
                      ?>
                      <div>
                        <p class="text-decoration-line-through text-muted mb-0">
                          Rp <?= number_format($product['harga_jual'], 0, ',', '.') ?>
                        </p>
                        <span class="fs-5 fw-bold text-success">
                          Rp <?= number_format($discounted_price, 0, ',', '.') ?>
                        </span>
                      </div>
                    <?php else : ?>
                      <span class="fs-5 fw-bold text-success">
                        Rp <?= number_format($product['harga_jual'], 0, ',', '.') ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </a>
                <div class="mt-2">
                  <?php if ($product['stok'] > 0): ?>
                    <a href="<?= base_url('customer/data_item/detail_item/' . $product['id_item']) ?>" 
                       class="btn btn-outline-success btn-sm">
                      <i class="fas fa-shopping-cart"></i> Detail
                    </a>
                    <small class="text-success d-block mt-2">
                      <i class="fas fa-check-circle"></i> Stok tersedia (<?= $product['stok'] ?>)
                    </small>
                  <?php else: ?>
                    <div class="d-flex justify-content-between align-items-center">
                      <a href="<?= base_url('customer/data_item/detail_item/' . $product['id_item']) ?>" 
                         class="btn btn-secondary btn-sm">
                        <i class="fas fa-info-circle"></i> Lihat Detail
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php $counter++; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="col-12 text-center">
          <p class="text-muted">Belum ada produk unggulan saat ini.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4" data-aos="fade-up">Apa Kata Pelanggan Kami</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5>Budi Santoso</h5>
            <p class="text-muted mb-3">Jakarta</p>
            <div class="text-warning mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="card-text">"Kualitas sayuran dan buahnya sangat segar. Pengiriman cepat dan pelayanan ramah. Recommended!"</p>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5>Siti Rahayu</h5>
            <p class="text-muted mb-3">Bandung</p>
            <div class="text-warning mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="card-text">"Belanja di Fresh Station sangat praktis. Harga terjangkau dan kualitas produk terjamin. Pasti akan belanja lagi!"</p>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5>Ahmad Rizki</h5>
            <p class="text-muted mb-3">Surabaya</p>
            <div class="text-warning mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="card-text">"Pengiriman super cepat dan packaging aman. Sayuran dan buah masih segar saat sampai. Top markotop!"</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Keunggulan -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-4" data-aos="fade-up">Mengapa Memilih Fresh Station?</h2>
    <div class="row g-4">
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="text-center">
          <div class="feature-icon bg-success bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
            <i class="fas fa-truck"></i>
          </div>
          <h5>Pengiriman Cepat</h5>
          <p class="text-muted">Pesanan sampai dalam waktu maksimal 2 jam</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="text-center">
          <div class="feature-icon bg-success bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
            <i class="fas fa-leaf"></i>
          </div>
          <h5>100% Fresh</h5>
          <p class="text-muted">Produk segar langsung dari supplier terpercaya</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="text-center">
          <div class="feature-icon bg-success bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h5>Kualitas Terjamin</h5>
          <p class="text-muted">Garansi uang kembali jika kualitas tidak sesuai</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
        <div class="text-center">
          <div class="feature-icon bg-success bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
            <i class="fas fa-headset"></i>
          </div>
          <h5>Layanan 24/7</h5>
          <p class="text-muted">Customer service siap membantu setiap saat</p>
        </div>
      </div>
    </div>
  </div>
</section>


<style>
/* Chat Styles */
.live-chat-btn {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #28a745;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
  z-index: 1050;
}

.live-chat-btn:hover {
  transform: scale(1.1);
  background-color: #218838;
}

.live-chat-btn .unread-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: #dc3545;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 12px;
  font-weight: bold;
}

.chat-modal {
  position: fixed;
  bottom: 100px;
  right: 30px;
  width: 350px;
  height: 500px;
  background: white;
  border-radius: 15px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.2);
  display: none;
  z-index: 1051;
}

.chat-header {
  background: #28a745;
  color: white;
  padding: 15px;
  border-radius: 15px 15px 0 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.chat-messages {
  height: 370px;
  padding: 15px;
  overflow-y: auto;
}

.chat-input-area {
  padding: 15px;
  border-top: 1px solid #eee;
  display: flex;
  gap: 10px;
}

.message {
  margin-bottom: 10px;
  max-width: 80%;
  word-wrap: break-word;
}

.message.customer {
  margin-left: auto;
  background: #28a745;
  color: white;
  padding: 10px 15px;
  border-radius: 15px 15px 0 15px;
}

.message.admin {
  margin-right: auto;
  background: #f1f1f1;
  padding: 10px 15px;
  border-radius: 15px 15px 15px 0;
}

.message .time {
  font-size: 0.75rem;
  opacity: 0.8;
  margin-top: 5px;
}
</style>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });

    // Carousel initialization
    var myCarousel = new bootstrap.Carousel(document.getElementById('dashboardHeroCarousel'), {
      interval: 3000, // Waktu pergantian slide (dalam milidetik)
      ride: 'carousel', // Mengaktifkan auto-slide
      wrap: true, // Kembali ke awal setelah slide terakhir
      touch: true, // Mendukung gesture sentuh untuk mobile
      keyboard: true // Mendukung kontrol keyboard
    });

    // Live Chat Functionality
    const liveChatBtn = document.getElementById('liveChatBtn');
    const chatModal = document.getElementById('chatModal');
    const closeChatBtn = document.getElementById('closeChatBtn');
    const chatInput = document.getElementById('chatInput');
    const sendMessageBtn = document.getElementById('sendMessageBtn');
    const chatMessages = document.getElementById('chatMessages');
    const unreadBadge = liveChatBtn.querySelector('.unread-badge');

    // Load chat history when page loads
    function loadInitialMessages() {
        fetch('<?= base_url('customer/chat/get_messages') ?>', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                chatMessages.innerHTML = ''; // Clear existing messages
                data.messages.forEach(msg => {
                    appendMessage(msg);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        })
        .catch(error => console.error('Error loading messages:', error));
    }

    // Toggle chat modal
    liveChatBtn.addEventListener('click', () => {
        chatModal.style.display = chatModal.style.display === 'none' ? 'block' : 'none';
        if (chatModal.style.display === 'block') {
            loadInitialMessages();
            unreadBadge.style.display = 'none';
        }
    });

    closeChatBtn.addEventListener('click', () => {
        chatModal.style.display = 'none';
    });

    // Single unified send message function
    function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        // Clear input immediately
        chatInput.value = '';

        // Send to server
        fetch('<?= base_url('customer/chat/send_message') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data) {
                // Append message only after successful send
                appendMessage(data.data);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            } else {
                if (data.message === 'Please login first') {
                    window.location.href = '<?= base_url('login') ?>';
                }
                console.error('Failed to send message:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Load messages function
    function loadMessages() {
        fetch('<?= base_url('customer/chat/get_messages') ?>', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateChatMessages(data.messages);
            } else if (data.message === 'Please login first') {
                window.location.href = '<?= base_url('login') ?>';
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Update chat messages without clearing existing ones
    function updateChatMessages(newMessages) {
        const existingMessageIds = new Set(
            Array.from(chatMessages.children).map(el => el.dataset.messageId)
        );

        newMessages.forEach(msg => {
            if (!existingMessageIds.has(msg.id?.toString())) {
                appendMessage(msg);
            }
        });

        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Check for unread messages
    function checkUnreadMessages() {
        fetch('<?= base_url('customer/chat/get_unread_count') ?>', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.unread_count > 0) {
                unreadBadge.style.display = 'block';
                unreadBadge.textContent = data.unread_count;
            } else {
                unreadBadge.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Append message to chat
    function appendMessage(messageData) {
        const div = document.createElement('div');
        div.className = `message ${messageData.from_type}`;
        if (messageData.id) {
            div.dataset.messageId = messageData.id;
        }
        
        const time = messageData.created_at ? new Date(messageData.created_at) : new Date();
        const formattedTime = time.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });

        div.innerHTML = `
            ${messageData.message}
            <div class="time">${formattedTime}</div>
        `;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Event listeners
    sendMessageBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    // Load initial messages
    loadInitialMessages();

    // Set up periodic updates
    setInterval(() => {
        if (chatModal.style.display === 'block') {
            loadMessages();
        }
        checkUnreadMessages();
    }, 5000);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer Function
    function updateCountdown(element) {
        const endDate = new Date(element.dataset.end).getTime();
        
        function update() {
            const now = new Date().getTime();
            const distance = endDate - now;
            
            if (distance < 0) {
                element.innerHTML = '<span class="text-danger">Promo Berakhir!</span>';
                return;
            }
            
            // Time calculations
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Update the countdown display
            element.querySelector('.days').textContent = String(days).padStart(2, '0');
            element.querySelector('.hours').textContent = String(hours).padStart(2, '0');
            element.querySelector('.minutes').textContent = String(minutes).padStart(2, '0');
            element.querySelector('.seconds').textContent = String(seconds).padStart(2, '0');
        }
        
        // Update immediately
        update();
        // Update every second
        return setInterval(update, 1000);
    }
    
    // Initialize all countdown timers
    const countdownElements = document.querySelectorAll('.countdown-timer');
    countdownElements.forEach(element => {
        updateCountdown(element);
    });
});
</script>

<style>
/* Countdown Timer Styles */
.countdown-timer {
    font-family: 'Roboto Mono', monospace;
    font-size: 1.1rem;
    font-weight: bold;
}

.countdown-timer span {
    display: inline-block;
    min-width: 2ch;
    text-align: center;
}
</style>
