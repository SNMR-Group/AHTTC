<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
     /* Luxurious Hero Section */
.hero {
    background: url('https://source.unsplash.com/1600x900/?university,classroom') no-repeat center center/cover;
    color: #328f4a;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    padding: 30px 0;
}

/* Section Heading */
.section-heading {
    font-size: 2.5rem;
    font-weight: bold;
    color: rgb(15, 184, 91);
}

/* Modern Card Design with Hover Effect */
.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.4s ease-in-out;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 30px rgba(15, 184, 91, 0.5); /* Green neon glow */
    background: linear-gradient(135deg, rgba(15, 184, 91, 0.9), rgba(6, 129, 103, 0.9));
    color: white;
}

.card:hover .card-text {
    color: #f8f9fa;
}

/* Specialization Box */
.luxury-box {
    background: linear-gradient(135deg, rgb(12, 163, 100), rgb(6, 129, 103));
    color: white;
    padding: 20px;
    border-radius: 10px;
    font-size: 1.2rem;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.luxury-box:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg,rgb(11, 163, 100),rgb(9, 160, 102));
}

/* Apply Button */
.theme-btn {
    background: linear-gradient(135deg,rgb(16, 163, 102),rgb(13, 139, 87));
    color: white;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 30px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 5px 10px rgba(255, 126, 95, 0.5);
}

.theme-btn:hover {
    background: linear-gradient(135deg,rgb(15, 117, 75),rgb(16, 122, 57));
    transform: scale(1.1);
    box-shadow: 0px 10px 20px rgba(22, 165, 105, 0.7);
}

    </style>
<section class="hero text-center animate__animated animate__fadeInDown">
        <div class="container py-5">
            <h1 class="display-4 fw-bold">Bachelor of Education (B.Ed.)</h1>
            <p class="lead">Empowering Future Educators with Excellence</p>
        </div>
    </section>

    <!-- Eligibility Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-heading text-center mb-5 animate__animated animate__fadeInUp">Eligibility Criteria</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm animate__animated animate__zoomIn">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                            <h5 class="card-title mt-3">Educational Qualification</h5>
                            <p class="card-text">Graduates with at least 50% marks (45% for SC/ST) from a recognized university.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm animate__animated animate__zoomIn animate__delay-1s">
                        <div class="card-body text-center">
                            <i class="fas fa-edit fa-3x text-success"></i>
                            <h5 class="card-title mt-3">Entrance Test</h5>
                            <p class="card-text">Applicants must qualify for the university-approved B.Ed. entrance exam.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm animate__animated animate__zoomIn animate__delay-2s">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-3x text-danger"></i>
                            <h5 class="card-title mt-3">Course Duration</h5>
                            <p class="card-text">The B.Ed. program spans 2 years (4 semesters).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specializations -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-heading text-center mb-5 animate__animated animate__fadeInUp">Specializations</h2>
            <div class="row text-center g-3">
                <div class="col-md-3">
                    <div class="luxury-box animate__animated animate__pulse animate__infinite">Mathematics</div>
                </div>
                <div class="col-md-3">
                    <div class="luxury-box animate__animated animate__pulse animate__infinite animate__delay-1s">Science</div>
                </div>
                <div class="col-md-3">
                    <div class="luxury-box animate__animated animate__pulse animate__infinite animate__delay-2s">History</div>
                </div>
                <div class="col-md-3">
                    <div class="luxury-box animate__animated animate__pulse animate__infinite animate__delay-3s">Sociology</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Apply Now -->
    <section id="apply" class="py-5 text-center">
        <div class="container animate__animated animate__fadeInUp">
            <h2 class="section-heading">Start Your Journey</h2>
            <p class="lead">Apply today to become a part of our esteemed institution.</p>
            <a href="apply.php" class="btn theme-btn btn-lg animate__animated animate__bounce">Apply Now</a>
        </div>
    </section>
