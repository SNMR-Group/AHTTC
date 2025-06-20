<section class="bg-light py-5">
  <div class="container">
    <h1 class="text-center mb-5 animate__animated animate__fadeInUp theme-btn">About Us</h1>

    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card shadow-lg border-0 p-4">
          <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s">
            Established in 1983, Al-Habeeb Teachers' Training College (AHTTC) was founded under the aegis of the Imamul Hai Khan Educational Society (IHKES). The society was formed in memory of the late Imamul Hai Khan, a revered freedom fighter, former coal cutter, and ex-minister in the Bihar Assembly. His dedication to education and societal upliftment inspired the establishment of AHTTC in Sector-6, Bokaro Steel City, Jharkhand.
          </p>
          <p class="text-muted animate__animated animate__fadeInUp animate__delay-2s">
            Since its inception, AHTTC has been committed to providing quality teacher education. The college offers a two-year Bachelor of Education (B.Ed) program, aimed at molding future educators with the skills and knowledge necessary to excel in the teaching profession. Our curriculum is designed to develop contextual and conceptual competencies, integrate Information & Communication Technology in education, and foster a professional attitude towards teaching.
          </p>
          <p class="text-muted animate__animated animate__fadeInUp animate__delay-3s">
            Our facilities include spacious, well-ventilated classrooms, fully-equipped science and language laboratories, a comprehensive library, computer rooms, and an auditorium. These resources ensure that our students receive a holistic education, combining theoretical knowledge with practical application.
          </p>
          <p class="text-muted animate__animated animate__fadeInUp animate__delay-4s">
            AHTTC is permanently affiliated with Binod Bihari Mahto Koylanchal University, Dhanbad, and is approved by the National Council for Teacher Education (NCTE), Bhubaneswar. Our commitment to academic excellence and adherence to regulatory standards underscores our dedication to nurturing competent and compassionate educators.
          </p>
        </div>
      </div>
    </div>

    <!-- Core Values Section -->
    <div class="mt-5">
      <h5 class="text-center text-warning animate__animated animate__fadeInUp">Our Core Values</h5>
      <div class="row justify-content-center mt-4">
        <div class="col-md-10">
          <div class="row g-4">
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Commitment to Lifelong Learning</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-1s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Upholding Professional Integrity</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-2s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Fostering Teamwork & Collaboration</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-3s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Encouraging Scientific Inquiry</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-4s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Promoting Equality & Fairness</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-5s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Embracing Cultural Diversity</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-6s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Nurturing Global Citizenship</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-7s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Striving for Academic & Personal Excellence</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-8s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Encouraging Environmental Responsibility</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card value-card shadow-sm border-0 animate__animated animate__fadeInLeft animate__delay-9s">
                <div class="card-body text-center">
                  <h6 class="text-dark fw-bold">Guided by Truth, Virtue & Beauty</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Counter Section -->
  <div class="mt-5 text-center animate__animated animate__fadeInUp">
    <?php require 'components/counter.php'; ?>
  </div>
</section>

<style>
  .animate__animated {
    visibility: hidden;
  }

  .animate__animated.animate__fadeInUp,
  .animate__animated.animate__fadeInLeft {
    visibility: visible;
    animation-duration: 5s;
    animation-fill-mode: both;
  }

  .card {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  }

  .value-card {
    background: #ffffff;
    border-left: 5px solid #FFD700;
    padding: 10px;
  }

  .theme-btn {
    /* font-size: 2rem; */
    font-weight: bold;
    color: #343a40;
  }
</style>
