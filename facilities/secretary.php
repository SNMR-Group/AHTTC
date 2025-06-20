<style>
    .library-image-effect {
    transition: transform 0.3s ease-in-out;
}

.library-image-effect:hover {
    transform: scale(1.05);
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.explore-btn {
    border-radius: 50px;
    text-transform: uppercase;
    transition: all 0.3s ease-in-out;
}

.explore-btn:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}
.library-image img {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
.library-section {
    background: linear-gradient(135deg, #f7f7f7 0%, #f1f1f1 100%);
}
</style>

<section class="library-section py-5 bg-warning">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="library-image">
                    <img src="images/kp1.png" alt="rgmttc" class="img-fluid rounded shadow-lg library-image-effect">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="library-content">
                    <!-- 📚 Library - The Heart of Learning -->
                    <h3 class="fw-bold theme-btn mb-4 library-title">Secretary cum Director</h3>
                    <p class="text-muted mb-4" style="font-size: 1rem; line-height: 1.8;">
                      Welcome to Rajiv Gandhi Memorial Telecom Training Centre (RGMTTC), a premier institution dedicated to technical education and skill development in the telecom sector. Our focus is on providing industry-relevant training, hands-on experience, and a strong foundation in emerging technologies. With experienced faculty, modern infrastructure, and a commitment to excellence, we strive to equip students with the knowledge and expertise needed to excel in their careers. At RGMTTC, we believe in fostering innovation, practical learning, and professional growth to prepare our students for a successful future.
                    </p>
                    <ul class="list-unstyled text-muted mt-4" style="font-size: 1rem; line-height: 1.8;">
                    </ul>   
                </div>
            </div>
        </div>
    </div>
</section>
