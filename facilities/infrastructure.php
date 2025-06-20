<section class="container my-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h2 class="text-success fw-bold display-4 text-uppercase" style="letter-spacing: 2px; color: #2E8B57;" data-aos="fade-down">World-Class Infrastructure</h2>
        <p class="text-muted fs-5" data-aos="fade-up">Discover the state-of-the-art facilities designed to provide the best learning experience.</p>
    </div>

    <div class="position-relative text-center mb-5 overflow-hidden" style="border-radius: 20px; background: linear-gradient(to bottom, rgba(46, 139, 87, 0.5), rgba(255, 255, 255, 0.5));" data-aos="zoom-in">
        <img src="images/home-bg-5.png" class="img-fluid w-100 shadow-lg" style="max-height: 500px; object-fit: cover; filter: brightness(80%);" alt="Infrastructure Overview">
        <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-50 text-white p-4 rounded-3 shadow-lg" style="backdrop-filter: blur(10px);">
            <h3 class="fw-bold text-uppercase" data-aos="fade-up">Modern & Fully Equipped Campus</h3>
            <p class="fs-5" data-aos="fade-up">Ensuring quality education with advanced infrastructure.</p>
        </div>
    </div>

    <!-- Facilities Grid Section -->
    <div class="row g-4" data-aos="fade-up">
        <div class="col-md-6" data-aos="fade-right">
            <div class="card border-0 shadow-lg facility-card" style="background: rgba(46, 139, 87, 0.2); backdrop-filter: blur(20px); border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="card-body text-center py-5">
                    <h4 class="text-success fw-bold text-uppercase" style="letter-spacing: 1px;">Ground Floor</h4>
                    <p class="fs-10 text-dark">Includes Lobby, Account Room, Principal Room, Teacher’s Common Room, Classrooms, IQAC Room, Sports Room, Toilets, and Corridor.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <div class="card border-0 shadow-lg facility-card" style="background: rgba(46, 139, 87, 0.2); backdrop-filter: blur(20px); border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="card-body text-center py-5">
                    <h4 class="text-success fw-bold text-uppercase" style="letter-spacing: 1px;">First Floor</h4>
                    <p class="fs-10 text-dark">Comprises Library, Classrooms, ET Lab, Conference Room, Curriculum Lab, Common Room (Boys), Toilets, and Corridor.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Section for Floor Details -->
    <div class="text-center mt-5" data-aos="flip-up">
        <h3 class="text-success fw-bold text-uppercase" style="color: #2E8B57;">Infrastructure Details</h3>
        <img src="images/infras.png" class="img-fluid rounded-4 shadow-lg mt-3" alt="Infrastructure Details" data-aos="fade-up">
    </div>
</section>

<!-- AOS Animation Library -->
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });

    // Card Hover Animation
    document.querySelectorAll('.facility-card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.transform = 'scale(1.05)';
            card.style.boxShadow = '0 10px 20px rgba(0, 128, 0, 0.3)';
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = 'scale(1)';
            card.style.boxShadow = '0 4px 8px rgba(0, 128, 0, 0.1)';
        });
    });
</script>
