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
                    <img src="images/libss.png" alt="rgmttc" class="img-fluid rounded shadow-lg library-image-effect">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="library-content">
                    <h3 class="fw-bold theme-btn mb-4 library-title">📚 Library - The Heart of Learning</h3>
                    <p class="text-muted mb-4" style="font-size: 1rem; line-height: 1.8;">
                        The library is the heart of our educational institution, located on the ground floor of the college building. 
                        It is a hub of knowledge equipped with a variety of resources to support the academic pursuits of students and faculty.
                    </p>
                    <ul class="list-unstyled text-muted mt-4" style="font-size: 1rem; line-height: 1.8;">
                        <li>📖 Reading Room for focused study sessions.</li>
                        <li>📚 Stack Room with a wide range of books and journals.</li>
                        <li>🖥 Library Office for seamless resource management.</li>
                        <li>🪑 Seating for up to 60 students at a time.</li>
                    </ul>
                    <a href="index" class="btn theme-btn mt-4 px-4 py-2 fw-semibold text-dark shadow-lg explore-btn">Explore Library</a>
                </div>
            </div>
        </div>
    </div>
</section>
