<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHTTC | Home</title>
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


  

</head>
<style>
  /* Unique Choose Us Section */
.choose-area {
   background: var(--footer-bg);
    color: #ffffff;
    padding: 80px 0;
    border-radius: 10px;
    overflow: hidden;
}

.choose-content {
    padding: 20px;
}

.site-title {
    font-size: 32px;
    font-weight: bold;
    color:rgb(187, 202, 68);
    margin-bottom: 20px;
}

.site-title .highlight {
    color: #00ffcc;
}

.description {
    font-size: 16px;
    color: #bbbbbb;
}

.choose-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.choose-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease-in-out;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.choose-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 4px 20px rgba(0, 255, 204, 0.3);
    border-color: #00ffcc;
}

.choose-icon img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.choose-card h4 {
    font-size: 18px;
    font-weight: 600;
    color: #ffffff;
}

.choose-card p {
    font-size: 14px;
    color: #cccccc;
}

@media (max-width: 768px) {
    .choose-grid {
        grid-template-columns: 1fr;
    }
}
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    .carousel-item {
        position: relative;
        height: 180vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        top: 0;
        left: 0;
    }

    .hero-content {
    position: relative;
    top: 10rem;
    bottom: 10rem;
    z-index: 2;
    text-align: center;
    color: #fff;
    max-width: 700px;
    min-height: 350px; /* Increased height */
    padding: 50px 40px; /* More padding for better spacing */
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    animation: fadeInUp 1s ease-in-out;
}


    .hero-title {
        font-size: 3rem;
        font-weight: bold;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .hero-title span {
        color: #28a745;
    }

    .hero-sub-title {
        font-size: 2.2rem;
        font-weight: 600;
        opacity: 0.8;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-btn {
        margin-top: 20px;
    }

    .hero-btn .theme-btn {
        background: #28a745;
        color: #333;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease-in-out;
    }

    .hero-btn .theme-btn:hover {
        background: #28a745;
        color: #fff;
    }

    .theme-btn2 {
        background: transparent;
        border: 2px solid #fff;
        color: #fff;
        margin-left: 15px;
    }

    .theme-btn2:hover {
        background: #fff;
        color: #333;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(100%);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .card {
        border-radius: 15px;
    }
    .scroll-container {
        max-height: 250px;
        overflow-y: auto;
    }
    .scroll-container::-webkit-scrollbar {
        width: 5px;
    }
    .scroll-container::-webkit-scrollbar-thumb {
        background: #198754;
        border-radius: 10px;
    }
    .list-group-item {
        transition: all 0.3s ease-in-out;
    }
    .list-group-item:hover {
        background: rgba(25, 135, 84, 0.1);
        transform: scale(1.02);
    }

    @keyframes scrollNotice {
        0% {
            transform: translateX(100%);
           
        }

        100% {
            transform: translateX(-100%);
          
        }
    }

   
    .scroll-container {
        height: 250px;
        overflow: hidden;
        position: relative;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .scroll-content {
        position: absolute;
        animation: scrollUp 15s linear infinite;
        width: 100%;
    }

    .scroll-container:hover .scroll-content {
        animation-play-state: paused;
    }

   
    @keyframes scrollUp {
        0% {
            top: 100%;
        }

        100% {
            top: -100%;
        }
    }

    .section-title {
        color: var(--hero-overlay-color);
        font-weight: bold;
    }

    .list-group-item {
        font-size: 1.1rem;
    }

    .icon {
        color: var(--hero-overlay-color);
        margin-right: 8px;
    }
    .director-image {
    position: relative;
    display: inline-block;
}

.director-image::before {
    content: '';
    position: absolute;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255, 223, 0, 0.3), transparent);
    border-radius: 50%;
    top: -15px;
    right: -15px;
    animation: glowAnimation 2s infinite alternate;
}

@keyframes glowAnimation {
    from {
        transform: scale(1);
        opacity: 0.8;
    }
    to {
        transform: scale(1.2);
        opacity: 1;
    }
}

.cta-wrapper {
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

.cta-wrapper:hover {
    box-shadow: 0 15px 50px rgba(255, 223, 0, 0.4);
}

.bi-quote {
    font-size: 3rem;
    color: gold;
    opacity: 0.8;
}
.link-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    /* Logo Styling */
    .link-icon img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #fff;
        padding: 10px;
        transition: transform 0.3s ease-in-out;
    }

    /* Hover Effects */
    .link-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 255, 127, 0.4);
    }
    .link-card:hover .link-icon img {
        transform: scale(1.1) rotate(5deg);
    }

    /* Dark Theme Background */
    .containers {
        background: linear-gradient(135deg, #004d40, #198754);
        padding: 40px;
        border-radius: 20px;
    }

    h2 {
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .custom-color {
    color: #fffff; /* Choose a color you like */
}


</style>

<body>
    <?php
    require 'components/nav.php';
    ?>

    <main class="main">

       
    <div class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('images/home-bg-8.png');">
                <div class="overlay"></div>
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="hero-content">
                        <h6 class="hero-sub-title">Welcome To AHTTC!</h6>
                        <h1 class="hero-title">Unleash Your Talent for a <span>Bright Future!</span></h1>
                        <p> We offer a variety of courses to help you develop new skills and expand your knowledge, tailored to fit different learning goals and career needs.</p>
                        <div class="hero-btn">
                            <a href="about.php" class="theme-btn">About More</a>
                            <a href="contact.php" class="theme-btn theme-btn2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url('images/home-bg-7.png');">
                <div class="overlay"></div>
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="hero-content">
                        <h6 class="hero-sub-title">Welcome To AHTTC!</h6>
                        <h1 class="hero-title">Unlock Your Future with <span>Exceptional</span> Education</h1>
                        <p>  Our university is led by experienced educators dedicated to delivering top-quality learning, empowering students to excel academically and achieve their career aspirations.</p>
                        <div class="hero-btn">
                            <a href="about.php" class="theme-btn">About More</a>
                            <a href="contact.php" class="theme-btn theme-btn2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url('images/home-bg-3.png');">
                <div class="overlay"></div>
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="hero-content">
                        <h6 class="hero-sub-title">Welcome To AHTTC!</h6>
                        <h1 class="hero-title">Empower Your Future with <span>Excellence</span> in Education</h1>
                        <p> Our university brings together expert faculty dedicated to delivering high-quality education, mentoring students, and equipping them with the skills needed for a successful academic and professional journey.</p>
                        <div class="hero-btn">
                            <a href="about.php" class="theme-btn">About More</a>
                            <a href="contact.php" class="theme-btn theme-btn2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url('images/home-bg-4.png');">
                <div class="overlay"></div>
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="hero-content">
                        <h6 class="hero-sub-title">Welcome To AHTTC!</h6>
                        <h1 class="hero-title">Unlock Your Potential with <span>Excellence</span></h1>
                        <p> Our university is dedicated to fostering knowledge and growth, with expert faculty who inspire, mentor, and prepare students for a bright academic and professional future.</p>
                        <div class="hero-btn">
                            <a href="about.php" class="theme-btn">About More</a>
                            <a href="contact.php" class="theme-btn theme-btn2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url('images/home-bg-5.png');">
                <div class="overlay"></div>
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="hero-content">
                        <h6 class="hero-sub-title">Welcome To AHTTC!</h6>
                        <h1 class="hero-title">Begin Your Journey to a <span>Successful</span> Future</h1>
                        <p> Enrolling in our university opens doors to a world of opportunities, empowering you with knowledge, skills, and experiences for a thriving career ahead.</p>
                        <div class="hero-btn">
                            <a href="about.php" class="theme-btn">About More</a>
                            <a href="contact.php" class="theme-btn theme-btn2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
       



<div class="container">
    <div class="row">
        <!-- Notices Section -->
        <div class="col-lg-6 col-md-12 pt-4" data-aos="fade-right">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0"><i class="bi bi-megaphone-fill me-2"></i>Notices</h5>
                    <button class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#noticesContent">
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
                <div id="noticesContent" class="collapse show">
                    <div class="card-body">
                        <div class="scroll-container">
                            <ul class="list-group list-group-flush scroll-content">
                                <?php require "get_notices.php"; ?>
                                <?php foreach ($notices as $notice): ?>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text me-2 text-success"></i>
                                        <a href="<?php echo htmlspecialchars($notice['link']); ?>" target="_blank" class="text-dark text-decoration-none">
                                            <?php echo htmlspecialchars($notice['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Objectives Section -->
        <div class="col-lg-6 col-md-12 pt-4" data-aos="fade-left">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="m-0"><i class="bi bi-flag-fill me-2"></i>Our Objectives</h5>
                </div>
                <div class="card-body">
                    <div class="scroll-container">
                        <ul class="list-group list-group-flush scroll-content">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Equip future teachers with modern teaching methods.</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Foster ethics, responsibility, and dedication in educators.</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Improve classroom management for better learning.</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Enhance communication and leadership skills.</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Provide real-world teaching experience.</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span>Conduct engaging workshops for skill development.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      

       
<div class="cta-area position-relative py-5" style="margin-top: 100px; background: linear-gradient(135deg, #004d40, #198754);">
    <div class="container">
        <div class="cta-wrapper text-white p-4 rounded shadow-lg position-relative" data-aos="fade-left" 
            style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); border-radius: 20px;">
            
            <div class="row align-items-center">
                
                <!-- Director's Image -->
                <div class="col-lg-4 text-center text-lg-start" data-aos="fade-right">
                    <div class="director-image" style="position: relative;">
                        <img src="images/director (3).png" alt="Al-Habeeb Teacher Training College" 
                            class="img-fluid rounded-circle shadow-lg" style="max-width: 250px; border: 4px solid gold;">
                        <span class="glow-effect"></span>
                    </div>
                </div>

                <!-- Quote Section -->
                <div class="col-lg-8 text-center">
                    <div class="cta-content" data-aos="fade-left">
                        <i class="bi bi-quote text-warning fs-1"></i>
                        <p class="fs-4 fw-light fst-italic text-white" style="font-family: 'Playfair Display', serif;">
                            "Education is the foundation of growth, shaping both individuals and societies. With India having 550 million young people under 25, our country is set to play a major role in the global workforce, driving progress and innovation worldwide."
                        </p>
                        <p class="fw-bold mt-3 text-warning fs-5"><em>- Dr. Raees Ahmed Khan, Founder & Mentor</em></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

       


       
<div class="containers mt-5" data-aos="fade-left">
    <h2 class="text-center fw-bold text-uppercase text-success">Useful Links</h2>
    
    <div class="row mt-4 justify-content-center">
        <!-- Link Cards -->
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="https://www.bbmkuniv.in/login" target="_blank" class="link-card">
                <div class="link-icon">
                    <img src="https://www.bbmkuniv.in/resources/image/logo_binodbihari.png" alt="Al-Habeeb Teacher Training College">
                </div>
                <h5>BBMKU-login</h5>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <a href="https://jac.jharkhand.gov.in/" target="_blank" class="link-card">
                <div class="link-icon">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/JAC_Ranchi.png" alt="Al-Habeeb Teacher Training College">
                </div>
                <h5>JAC</h5>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <a href="https://www.stackoverflow.com" target="_blank" class="link-card">
                <div class="link-icon">
                    <img src="https://ncte.gov.in/Website/images/logo_B1.png" alt="NCTE">
                </div>
                <h5>NCTE.gov</h5>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <a href="https://ekalyan.cgg.gov.in/" target="_blank" class="link-card">
                <div class="link-icon">
                    <img src="https://ekalyan.cgg.gov.in/new-template/img/newJrEmblem.jpg" alt="Al-Habeeb Teacher Training College">
                </div>
                <h5>e-Kalyan</h5>
            </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <a href="https://jceceb.jharkhand.gov.in/" target="_blank" class="link-card">
                <div class="link-icon">
                    <img src="images/jcece.png" alt="Al-Habeeb Teacher Training College">
                </div>
                <h5>JCECE</h5>
            </a>
        </div>
    </div>
</div>


<div class="video-area mt-5 position-relative">
    <div class="container"> 
        <div class="row g-4 align-items-center">
            <!-- Video Section -->
            <div class="col-lg-8" data-aos="fade-left">
                <div class="video-content position-relative rounded-4 overflow-hidden shadow-lg" 
                    style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 20px;">
                    <div class="video-wrapper position-relative">
                        <!-- Background Image -->
                        <img src="images/home-bg-5.png" alt="Al-Habeeb Teacher Training College" class="img-fluid rounded-4">
                        <!-- Play Button -->
                        <a class="play-btn position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center" 
                            href="javascript:void(0);" onclick="openVideoWindow()" 
                            style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; backdrop-filter: blur(5px); transition: 0.3s;">
                            <i class="fas fa-play text-white fs-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Left Content Section -->
            <div class="col-lg-4 d-flex flex-column justify-content-center text-white ps-lg-5" data-aos="fade-right">
                <div class="site-heading mb-3">
                    <span class="site-title-tagline text-success"><i class="bi bi-book"></i> Latest Video</span>
                    <h2 class="site-title text-dark">
                        Let's Check Our <span class="text-success">Latest</span> Video
                    </h2>
                </div>
                <p class="about-text text-muted">
                    Stay updated with our latest insights, tutorials, and discussions. Engage with our informative videos to expand your knowledge.
                </p>
                <a href="about.php" class="theme-btn mt-3 btn btn-outline-success px-4 py-2">Learn More <i class="fas fa-arrow-right-long ms-2"></i></a>
            </div>
        </div>
    </div>
</div>

<section class="choose-area mt-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="choose-content">
                    <span class="site-title-tagline"><i class="bi bi-star-fill"></i> Why Choose Us</span>
                    <h2 class="site-title">
                        <span class="custom-color">We Are Experts & </span>
                        <span class="highlight">Do Our Best</span>
                        <span class="custom-color"> For Your Goal</span></h2>
                    <p class="description">
                        Join a learning environment where quality meets expertise. Our institution ensures top-notch education with expert faculty, flexible learning, and affordability.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-grid">
                    <div class="choose-card">
                        <div class="choose-icon">
                            <img src="images/icons/teacher-2.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <h4>Expert Faculty</h4>
                        <p>Learn from seasoned professionals with real-world expertise.</p>
                    </div>
                    <div class="choose-card">
                        <div class="choose-icon">
                            <img src="images/icons/courses.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <h4>Premium Materials</h4>
                        <p>Access curated, research-backed course content.</p>
                    </div>
                    <div class="choose-card">
                        <div class="choose-icon">
                            <img src="images/icons/online-courses.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <h4>Flexible Learning</h4>
                        <p>Choose between in-person, live, and recorded classes.</p>
                    </div>
                    <div class="choose-card">
                        <div class="choose-icon">
                            <img src="images/icons/money.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <h4>Affordable Excellence</h4>
                        <p>High-quality education at an unbeatable price.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</section>
        
        <?php require 'components/counter.php'; ?>
        
        <?php require 'components/partner.php'; ?>
       


    </main>


    <?php require 'components/footer.php'; ?>
    <?php require 'components/scrollup.php'; ?>

   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- GSAP for animations -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script> -->
    <script>
        AOS.init();
    </script>
   
    <script>
        function openVideoWindow() {
            var videoUrl = "https://www.youtube.com/watch?v=KNkXQBOMuUY"; 
            var width = 600; 
            var height = 400; 
            var left = (window.innerWidth / 2) - (width / 2); 
            var top = (window.innerHeight / 2) - (height / 2); 

            
            var videoWindow = window.open(videoUrl, "videoWindow", "width=" + width + ", height=" + height + ", top=" + top + ", left=" + left + ", resizable=no, scrollbars=no");

           
            if (videoWindow) {
                videoWindow.focus();
            }
        }
    </script>

    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Animate the left column
        gsap.from(".choose-content", {
            opacity: 0,
            x: -50,
            duration: 1,
            scrollTrigger: {
                trigger: ".choose-content",
                start: "top 80%",
                toggleActions: "play none none none",
            },
        });

        // Animate the right column
        gsap.from(".choose-img", {
            opacity: 0,
            x: 50,
            duration: 1,
            scrollTrigger: {
                trigger: ".choose-img",
                start: "top 80%",
                toggleActions: "play none none none",
            },
        });

        // Animate cards
        gsap.from(".luxury-card", {
            opacity: 0,
            y: 50,
            stagger: 0.2,
            duration: 1,
            scrollTrigger: {
                trigger: ".choose-content-wrap",
                start: "top 70%",
                toggleActions: "play none none none",
            },
        });
    </script>
    
</body>

</html>