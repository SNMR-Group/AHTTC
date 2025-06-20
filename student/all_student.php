<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers' Training College - Student Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1b5e20; /* Dark green */
            --secondary-color: #2e7d32; /* Medium green */
            --accent-color: #4caf50; /* Light green */
            --light-bg: #e8f5e9; /* Very light green */
            --highlight-color: #81c784; /* Highlight green */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            border-top: 4px solid var(--primary-color);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 1.2rem;
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .bg-light-green {
            background-color: var(--light-bg);
        }

        .stats-counter {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .highlight-box {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .highlight-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .alumni-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-left: 4px solid var(--primary-color);
        }

        .alumni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .alumni-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            margin-bottom: 15px;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .stats-counter {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Quick Stats -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-box">
                        <span class="stats-counter" data-target="1200">0</span>
                        <h5>Current Students</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-box">
                        <span class="stats-counter" data-target="8500">0</span>
                        <h5>Alumni Network</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-box">
                        <span class="stats-counter" data-target="95">0</span>
                        <h5>Placement Rate %</h5>
                    </div>
                </div>
              
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-5 bg-light-green">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Our Teacher Education Programs</h2>
                    <p class="lead">Choose the path that matches your teaching aspirations</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Bachelor of Education (B.Ed)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <div class="feature-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <p><strong>Duration:</strong> 2 Years</p>
                                    <p><strong>Eligibility:</strong> Graduation</p>
                                </div>
                                <div class="col-md-8">
                                    <h5>Program Highlights:</h5>
                                    <ul>
                                        <li>Prepares teachers for secondary and senior secondary levels</li>
                                        <li>Specializations in Science, Arts, and Commerce</li>
                                        <li>Extensive teaching practicum in partner schools</li>
                                        <li>Research project in final semester</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <button class="btn btn-primary">Learn More</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Diploma in Elementary Education (D.El.Ed)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <div class="feature-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <p><strong>Duration:</strong> 2 Years</p>
                                    <p><strong>Eligibility:</strong> 10+2</p>
                                </div>
                                <div class="col-md-8">
                                    <h5>Program Highlights:</h5>
                                    <ul>
                                        <li>Prepares teachers for elementary level (Classes 1-8)</li>
                                        <li>Child-centered pedagogy approach</li>
                                        <li>Focus on foundational literacy and numeracy</li>
                                        <li>Practical training in diverse classroom settings</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <button class="btn btn-primary">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admission Section -->
    <section id="admission" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Admission Process</h2>
                    <p class="lead">Your journey to becoming an educator starts here</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4>Check Eligibility</h4>
                        <p>Review the requirements for your desired program to ensure you qualify for admission.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h4>Complete Application</h4>
                        <p>Fill out our online application form with your personal and academic details.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <h4>Submit Documents</h4>
                        <p>Upload all required supporting documents through our secure portal.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <h4>Entrance Exam</h4>
                        <p>Appear for our entrance examination (if applicable to your program).</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Counseling Session</h4>
                        <p>Attend a counseling session to discuss your teaching career aspirations.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="highlight-box text-center">
                        <div class="feature-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4>Enrollment</h4>
                        <p>Complete the enrollment formalities and begin your teaching journey!</p>
                    </div>
                </div>
            </div>
            
            <!--<div class="row mt-5">-->
            <!--    <div class="col-12 text-center">-->
            <!--        <button class="btn btn-primary btn-lg">-->
            <!--            <i class="fas fa-download me-2"></i>Download Complete Admission Guide-->
            <!--        </button>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </section>

    <!-- Alumni Section -->
    <section id="alumni" class="py-5 bg-light-green">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Our Alumni Community</h2>
                    <p class="lead">Join our network of successful educators</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="alumni-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Alumni" class="alumni-img">
                        <h5>Priya Sharma</h5>
                        <p class="text-muted">B.Ed 2018-2020</p>
                        <p>"The practical teaching experience I gained was invaluable in my career as a high school teacher."</p>
                        <p class="text-success fw-bold">Mathematics Teacher, DPS</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="alumni-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alumni" class="alumni-img">
                        <h5>Rahul Verma</h5>
                        <p class="text-muted">D.El.Ed 2017-2019</p>
                        <p>"The child-centered approach I learned transformed how I teach first-generation learners."</p>
                        <p class="text-success fw-bold">Founder, Rural Education Initiative</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="alumni-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Alumni" class="alumni-img">
                        <h5>Anjali Patel</h5>
                        <p class="text-muted">B.Ed 2015-2017</p>
                        <p>"The research skills I developed helped me create innovative teaching methods."</p>
                        <p class="text-success fw-bold">Head of Department, KV</p>
                    </div>
                </div>
            </div>
            
            <!--<div class="row mt-5">-->
            <!--    <div class="col-12 text-center">-->
            <!--        <button class="btn btn-primary btn-lg me-3">-->
            <!--            <i class="fas fa-network-wired me-2"></i>Join Alumni Network-->
            <!--        </button>-->
            <!--        <button class="btn btn-outline-primary btn-lg">-->
            <!--            <i class="fas fa-handshake me-2"></i>Become a Mentor-->
            <!--        </button>-->
            <!--    </div>-->
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-4">Ready to Begin Your Teaching Journey?</h2>
                    <p class="lead mb-5" style="font-size: 1.25rem;">Applications are now open for the next academic session. Start your application today!</p>
                    <button class="btn btn-light btn-lg me-3">
                        <i class="fas fa-user-graduate me-2"></i>Apply Now
                    </button>
                    <button class="btn btn-outline-light btn-lg" onclick="showContactInfo()">
                        <i class="fas fa-phone me-2"></i>Contact Admissions
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Alert (Hidden by default) -->
    <div id="contactAlert" class="alert alert-success alert-dismissible fade" role="alert" style="display: none; margin: 0; border-radius: 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-0"><i class="fas fa-phone me-2"></i> +91-6542266103, +91-8877164867</h5>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>ahttcbokaro@gmail.com</h5>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn-close" onclick="hideContactInfo()"></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling function
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Show/hide contact info
        function showContactInfo() {
            const alert = document.getElementById('contactAlert');
            alert.style.display = 'block';
            alert.classList.add('show');
            alert.scrollIntoView({ behavior: 'smooth' });
        }

        function hideContactInfo() {
            const alert = document.getElementById('contactAlert');
            alert.classList.remove('show');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 150);
        }

        // Animated counter function
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Start counter animation
            animateCounters();

            // Auto-hide contact alert after 10 seconds
            let contactTimeout;
            const originalShowContact = showContactInfo;
            showContactInfo = function() {
                originalShowContact();
                clearTimeout(contactTimeout);
                contactTimeout = setTimeout(hideContactInfo, 10000);
            };
        });
    </script>
</body>
</html>