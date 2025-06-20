<!-- Include Animate.css, Bootstrap & Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Hero Section - Slimmer */
        .hero {
    background: linear-gradient(135deg, #155840, #388E3C);
    color: white;
    padding: 14px 0;
    text-align: center;
    position: relative;
    box-shadow: 0px 5px 20px rgba(0, 100, 0, 0.3);
}
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 0 0 15px rgba(0, 255, 127, 0.6);
            animation: fadeInDown 1s ease-in-out;
        }
        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            animation: fadeInUp 1.2s ease-in-out;
        }

        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(46, 125, 50, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 100, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }
        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 255, 127, 0.5);
        }

        /* Horizontal Timeline */
        .timeline {
            display: flex;
            overflow-x: auto;
            padding: 20px 0;
            scroll-snap-type: x mandatory;
        }
        .timeline-step {
            flex: 0 0 auto;
            width: 250px;
            text-align: center;
            padding: 20px;
            scroll-snap-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            margin-right: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.3);
        }
        .timeline-step:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 255, 127, 0.6);
        }

        /* Career Grid */
        .career-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding-top: 20px;
        }
        .career-item {
            background: linear-gradient(135deg, #2E7D32, #66BB6A);
            color: white;
            padding: 15px;
            border-radius: 15px;
            font-weight: bold;
            width: 200px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.3);
        }
        .career-item:hover {
            transform: translateY(-10px) scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 255, 127, 0.5);
        }

        /* Floating Apply Button */
        .apply-btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #43A047, #81C784);
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0px 5px 15px rgba(0, 255, 127, 0.4);
            transition: transform 0.3s ease-in-out;
        }
        .apply-btn:hover {
            transform: scale(1.1);
            box-shadow: 0px 10px 20px rgba(0, 255, 127, 0.6);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeInDown">Diploma in Elementary Education (D.El.Ed)</h1>
            <p class="animate__animated animate__fadeInUp">Become a certified educator with our comprehensive 2-year program.</p>
        </div>
    </section>

    <!-- Eligibility Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-5">Eligibility Criteria</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="glass-card">
                        <h5>Educational Qualification</h5>
                        <p>10+2 with at least 50% marks (45% for SC/ST/OBC).</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="glass-card">
                        <h5>Age Criteria</h5>
                        <p>Minimum 18 years old. Maximum varies by state.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admission Process - Horizontal Scrollable Timeline -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container">
            <h2 class="mb-5">Admission Process</h2>
            <div class="timeline">
                <div class="timeline-step">
                    <i class="fas fa-file-alt fa-2x"></i>
                    <h5>Step 1: Application</h5>
                    <p>Submit your application online.</p>
                </div>
                <div class="timeline-step">
                    <i class="fas fa-clipboard-check fa-2x"></i>
                    <h5>Step 2: Entrance Exam</h5>
                    <p>Appear for the required entrance test.</p>
                </div>
                <div class="timeline-step">
                    <i class="fas fa-user-check fa-2x"></i>
                    <h5>Step 3: Interview</h5>
                    <p>Qualified students go through an interview.</p>
                </div>
                <div class="timeline-step">
                    <i class="fas fa-user-graduate fa-2x"></i>
                    <h5>Step 4: Admission</h5>
                    <p>Get admitted based on your performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Paths -->
    <section class="py-5 text-center">
        <div class="container">
            <h2>Career Opportunities</h2>
            <div class="career-grid">
                <div class="career-item">Primary School Teacher</div>
                <div class="career-item">Private School Educator</div>
                <div class="career-item">Daycare Coordinator</div>
                <div class="career-item">Education Consultant</div>
            </div>
        </div>
    </section>

    <!-- Apply Now -->
    <section class="py-5 text-center">
        <div class="container">
            <h2>Start Your Journey Today!</h2>
            <a href="apply.php" class="apply-btn">Apply Now</a>
        </div>
    </section>