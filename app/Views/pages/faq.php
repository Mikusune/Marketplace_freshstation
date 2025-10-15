<style>
    .accordion-button:not(.collapsed) {
        color: #fff;
        background-color: #6BB252;
    }
    
    .accordion-button:focus {
        border-color: #6BB252;
        box-shadow: 0 0 0 0.25rem rgba(107, 178, 82, 0.25);
    }
    
    .accordion-button.collapsed:hover {
        background-color: rgba(107, 178, 82, 0.1);
    }
    
    .accordion-button::after {
        transition: transform 0.3s ease-in-out;
    }
    
    .accordion-collapse {
        transition: all 0.3s ease-in-out;
    }
    
    .accordion-body {
        padding: 1rem;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center mb-5">FAQ / Pusat Bantuan</h1>

                <div class="accordion" id="faqAccordion">
                    <!-- Pembelian -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pembelian">
                                Pembelian
                            </button>
                        </h2>
                        <div id="pembelian" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="mb-4">
                                    <h5>Bagaimana cara melakukan pembelian?</h5>
                                    <p>1. Pilih produk yang ingin Anda beli<br>
                                       2. Tambahkan ke keranjang<br>
                                       3. Klik icon keranjang di pojok kanan atas<br>
                                       4. Klik "Continue to checkout"<br>
                                       5. Isi alamat pengiriman<br>
                                       6. Pilih metode pembayaran<br>
                                       7. Klik "Place Order"</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Metode pembayaran apa saja yang tersedia?</h5>
                                    <p>Kami menerima pembayaran melalui:<br>
                                       - Transfer bank<br>
                                       - E-wallet (OVO, GoPay, DANA)<br>
                                       - Virtual Account<br>
                                       - Kartu kredit/debit</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengiriman -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengiriman">
                                Pengiriman
                            </button>
                        </h2>
                        <div id="pengiriman" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="mb-4">
                                    <h5>Berapa lama waktu pengiriman?</h5>
                                    <p>Waktu pengiriman tergantung pada lokasi Anda:<br>
                                       - Area Bekasi: 1-2 hari<br>
                                       - Jabodetabek: 2-3 hari<br>
                                       - Luar Jabodetabek: 3-7 hari</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Apakah ada biaya pengiriman?</h5>
                                    <p>Biaya pengiriman dihitung berdasarkan berat dan jarak. Untuk pembelian di atas Rp 500.000 dalam area Bekasi, kami berikan gratis ongkir.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengembalian -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengembalian">
                                Pengembalian & Refund
                            </button>
                        </h2>
                        <div id="pengembalian" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="mb-4">
                                    <h5>Bagaimana kebijakan pengembalian barang?</h5>
                                    <p>Anda dapat mengembalikan barang dalam waktu 7 hari setelah penerimaan jika:<br>
                                       - Barang rusak/cacat<br>
                                       - Barang tidak sesuai deskripsi<br>
                                       - Kesalahan pengiriman produk</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Berapa lama proses refund?</h5>
                                    <p>Setelah barang diterima dan diperiksa oleh tim kami, proses refund akan dilakukan dalam waktu 3-7 hari kerja tergantung metode pembayaran yang Anda gunakan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Akun -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#akun">
                                Akun & Keamanan
                            </button>
                        </h2>
                        <div id="akun" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="mb-4">
                                    <h5>Bagaimana cara mengubah password?</h5>
                                    <p>1. Login ke akun Anda<br>
                                       2. Klik menu profil<br>
                                       3. Pilih "Change Password"<br>
                                       4. Masukkan password lama dan password baru<br>
                                       5. Klik "Update Password"</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Apa yang harus dilakukan jika lupa password?</h5>
                                    <p>Klik "Forgot Password" pada halaman login dan ikuti instruksi yang diberikan. Link reset password akan dikirim ke email Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hubungi Kami -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kontak">
                                Hubungi Kami 
                            </button>
                        </h2>
                        <div id="kontak" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="mb-4">
                                    <h5>Bagaimana cara menghubungi customer service?</h5>
                                    <p>Anda dapat menghubungi kami melalui:<br>
                                       - Live chat (klik ikon chat di pojok kanan bawah)<br>
                                       - Email: cs@freshstation.com<br>
                                       - WhatsApp: 0822-6059-0569<br>
                                       - Telepon: (021) 123-4567</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Kapan waktu operasional customer service?</h5>
                                    <p>Customer service kami tersedia:<br>
                                       Senin - Jumat: 07.00 - 20.00 WIB<br>
                                       Sabtu: 09.00 - 17.00 WIB<br>
                                       Minggu & Hari Libur: 10.00 - 15.00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Belum menemukan jawaban -->
                <div class="text-center mt-5">
                    <h5>Belum menemukan jawaban yang Anda cari?</h5>
                    <p>Silakan hubungi customer service kami melalui live chat atau kirim email ke cs@freshstation.com</p>
                </div>
            </div>
        </div>
    </div>
</div>