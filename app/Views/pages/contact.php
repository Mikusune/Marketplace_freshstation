<section class="contact-page py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="text-success fw-bold">Kontak Kami</h2>
                <p class="text-muted">Hubungi kami untuk informasi lebih lanjut atau kunjungi toko kami</p>
            </div>
        </div>

        <div class="row g-4 equal-height-row">
            <div class="col-lg-5">
                <div class="contact-info bg-success bg-opacity-10 p-4 rounded-3 h-100">
                    <div class="info-item mb-4">
                        <i class="fas fa-map-marker-alt text-success fs-4 mb-3"></i>
                        <h5 class="fw-bold">Alamat</h5>
                        <p class="text-muted mb-0">Jl. KH. Ahmad dahlan No.40, RT.2/RW.3, Kramat Pela, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12240
                    </div>

                    <div class="info-item mb-4">
                        <i class="fas fa-phone text-success fs-4 mb-3"></i>
                        <h5 class="fw-bold">WhatsApp</h5>
                        <p class="text-muted mb-0">+62 822-6059-0569</p>
                    </div>

                    <div class="info-item mb-4">
                        <i class="fas fa-envelope text-success fs-4 mb-3"></i>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted mb-0">info@freshstation.co.id</p>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-clock text-success fs-4 mb-3"></i>
                        <h5 class="fw-bold">Jam Operasional</h5>
                        <p class="text-muted mb-0">Senin - Minggu: 07:00 - 22:00<br>
                        Customer Service: 07:00 - 20:00</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="map-container rounded-3 overflow-hidden h-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1101866401946!2d106.79178979999999!3d-6.249208899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f100200735c9%3A0xf1637cc7cece754e!2sFresh%20Station%20Supermarket!5e0!3m2!1sid!2sid!4v1745593378045!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 490px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        
    </div>
</section>

<style>
.contact-page .info-item {
    position: relative;
    padding-left: 45px;
}

.contact-page .info-item i {
    position: absolute;
    left: 0;
    top: 0;
}

.contact-page .map-container {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.contact-page .form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.contact-page .btn-success:hover {
    transform: translateY(-2px);
    transition: transform 0.2s;
}

.equal-height-row {
    display: flex;
    flex-wrap: wrap;
}

.equal-height-row > [class*='col-'] {
    display: flex;
    flex-direction: column;
}

.map-container {
    display: flex;
    flex-direction: column;
}

.map-container iframe {
    flex-grow: 1;
}

@media (max-width: 991.98px) {
    .map-container iframe {
        min-height: 400px !important;
    }
}
</style>
