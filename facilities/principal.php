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
                    <img src="images/secre.png" alt="ahttc" class="img-fluid rounded shadow-lg library-image-effect">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="library-content">
                    <!-- 📚 Library - The Heart of Learning -->
                    <h3 class="fw-bold theme-btn mb-4 library-title">Principal Message</h3>
                    <p class="text-muted mb-4" style="font-size: 1rem; line-height: 1.8;">
                    At our teacher training institution, we are committed to shaping the next generation of educators by providing them with the knowledge, skills, and values needed to succeed in the classroom. Our focus is on delivering comprehensive training that blends theory with practical experience, fostering a deep understanding of pedagogy and child development. With a team of experienced faculty and modern teaching tools, we aim to equip future teachers with the confidence and capability to inspire and lead in educational settings. Our goal is to develop not just skilled educators but passionate professionals dedicated to making a positive impact on students’ lives.
                    </p>
                    <ul class="list-unstyled text-muted mt-4" style="font-size: 1rem; line-height: 1.8;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
