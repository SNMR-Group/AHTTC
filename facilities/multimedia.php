<style>
       
        .fade-in {
            opacity: 0;
            animation: fadeIn 4s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

       
        .fade-in-card {
            opacity: 0;
            animation: fadeInCard 4s ease-out forwards;
        }

        @keyframes fadeInCard {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

      
        .btn-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>

<section class="multimedia-section py-5 bg-light text-dark">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold text-dark theme-btn">🎥 Interactive Multimedia Hub</h3>
            <p class="lead text-muted">Redefining education through cutting-edge multimedia tools, designed for engagement and collaboration.</p>
        </div>
        <div class="row g-5">
            <div class="col-md-4 fade-in-card">
                <div class="card bg-white text-dark shadow-sm h-100 border border-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon-box text-white me-3 p-3 rounded-circle" style = "background : #116e63; ">
                                <i class="bi bi-tv"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Dynamic LCD Displays</h5>
                        </div>
                        <p class="text-muted">Make presentations captivating with high-resolution LCD projectors for dynamic teaching.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-in-card">
                <div class="card bg-white text-dark shadow-sm h-100 border border-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon-box text-white me-3 p-3 rounded-circle" style = "background : #116e63; ">
                                <i class="bi bi-laptop"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Smart Lecture Halls</h5>
                        </div>
                        <p class="text-muted">Integrated computers in lecture halls for seamless access to advanced tools and content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-in-card">
                <div class="card bg-white text-dark shadow-sm h-100 border border-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon-box text-white me-3 p-3 rounded-circle" style = "background  : #116e63; ">
                                <i class="bi bi-mic"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Immersive Audio Systems</h5>
                        </div>
                        <p class="text-muted">Premium audio equipment ensures every word is heard with perfect clarity, enhancing engagement.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-in-card">
                <div class="card bg-white text-dark shadow-sm h-100 border border-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon-box text-white me-3 p-3 rounded-circle" style = "background: #116e63; ">
                                <i class="bi bi-disc"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Video-Based Learning</h5>
                        </div>
                        <p class="text-muted">Explore concepts through VCD players and televisions, offering a visual and auditory experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 fade-in-card">
                <div class="card bg-white text-dark shadow-sm h-100 border border-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon-box text-white me-3 p-3 rounded-circle" style = "background  : #116e63; ">
                                <i class="bi bi-projector"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Overhead Projectors</h5>
                        </div>
                        <p class="text-muted">Simplify complex visuals with crystal-clear overhead projectors designed for effective instruction.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="index.php" class="btn px-4 py-2 fw-semibold shadow btn-hover" style = "background  : #116e63; ">Explore Multimedia Facilities</a>
        </div>
    </div>
</section>
