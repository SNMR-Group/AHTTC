<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-ABn0K18ZJJHptuEucAt5PeUj8XZBm+NEkd1/t5ZWDb0xrAk5w8hZ7kCDA0uNjDEc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <style>
        .top-banner {
            background-color: #fff;
            border-bottom: 2px solid #ddd;
        }

        .top-banner img {
            max-height: 80px;
            width: auto;
        }

        .animated-text {
            font-size: 20px;
            font-weight: bold;
            display: inline-block;
            background-image: linear-gradient(90deg, #004aad, #ff5722, #4caf50, #ffeb3b, #004aad);
            background-size: 300%;
            background-clip: text;
            -webkit-background-clip: text;
            color: var(--hero-overlay-color);
        }

        .subtitle {
            text-align: start;
            font-size: 18px;
            font-weight: 500;
            color: #555;
            letter-spacing: 1px;
        }

        .subtitle::before,
        .subtitle::after {
            content: "";
            display: inline-block;
            width: 50px;
            height: 2px;
            background-color: var(--hero-overlay-color);
            margin: 0 10px;
            vertical-align: middle;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .fa-brands,
        .fab {
            font-family: "Font Awesome 6 Brands";
        }

        .header-lg {
            position: 'sticky';
            top: 0;
        }

        .fixed-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 9999;
            animation: slideDown 0.7s;
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .single::after {
            display: inline-block;
            margin-left: 5px;
            vertical-align: baseline;
            font-family: 'Roboto', sans-serif;
            content: "";
            font-weight: 600;
            border: none;
            font-size: 12px;
        }

        .notice-container {
            width: 72%;
            overflow: hidden;
            background-color: transparent;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
            margin-top: 0;
            padding: 0;
        }

        .notice-wrapper {
            display: flex;
            justify-content: center;
            animation: scrollNotice 15s linear infinite;
            background-color: transparent;
        }

        .notice-message {
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: transparent;
        }

        @keyframes scrollNotice {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .new-badge {
            color: #fff;
            background-color: #ff4500;
            border-radius: 50%;
            padding: 0.15rem 0.4rem;
            font-size: 0.7rem;
            font-weight: bold;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        /* Improved Apply Now Button Styles */
        .apply-now-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .apply-now-btn:hover {
            background: linear-gradient(135deg, #218838, #1aa179);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            color: white;
            text-decoration: none;
        }

        .apply-now-btn:active {
            transform: translateY(0);
        }

        .apply-now-btn i {
            font-size: 14px;
        }

        /* Navigation improvements with better font sizes */
        .navbar-nav .nav-link {
            padding: 0.5rem 0.75rem !important;
            font-weight: 500;
            color: #333;
            transition: color 0.3s ease;
            font-size: 17px !important;
            white-space: nowrap;
        }

        .navbar-nav .nav-link:hover {
            color: #28a745;
        }

        .navbar-nav .nav-link.active {
            color: #28a745;
            font-weight: 600;
        }

        /* Dropdown menu improvements */
        .dropdown-menu {
            font-size: 13px !important;
            min-width: 180px !important;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }

        .dropdown-item {
            padding: 0.4rem 0.8rem !important;
            font-size: 13px !important;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #28a745;
        }

        /* Submenu styling */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            font-size: 12px !important;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        /* Responsive adjustments */
        @media (max-width: 1400px) {
            .navbar-nav .nav-link {
                font-size: 13px !important;
                padding: 0.5rem 0.65rem !important;
            }
            
            .apply-now-btn {
                font-size: 12px;
                padding: 7px 14px;
            }
        }

        @media (max-width: 1200px) {
            .navbar-nav .nav-link {
                font-size: 12px !important;
                padding: 0.4rem 0.55rem !important;
            }
            
            .apply-now-btn {
                font-size: 11px;
                padding: 6px 12px;
            }
            
            .dropdown-menu {
                font-size: 12px !important;
                min-width: 160px !important;
            }
            
            .dropdown-item {
                font-size: 12px !important;
                padding: 0.3rem 0.6rem !important;
            }
        }

        @media (max-width: 1100px) {
            .navbar-nav .nav-link {
                font-size: 11px !important;
                padding: 0.4rem 0.45rem !important;
            }
            
            .apply-now-btn {
                font-size: 10px;
                padding: 5px 10px;
            }
        }

        @media (max-width: 992px) {
            .navbar-nav .nav-link {
                font-size: 16px !important;
                padding: 0.75rem 1rem !important;
                text-align: left;
            }
            
            .dropdown-menu {
                font-size: 14px !important;
                min-width: 200px !important;
            }
            
            .dropdown-item {
                font-size: 14px !important;
                padding: 0.6rem 1rem !important;
            }
            
            .apply-now-btn {
                font-size: 14px;
                padding: 10px 20px;
                margin-top: 15px;
                width: auto;
                justify-content: center;
                display: block;
                text-align: center;
            }
            
            /* Ensure apply button doesn't get cut off on mobile */
            .navbar-collapse {
                padding-bottom: 1rem;
            }
        }

        @media (max-width: 768px) {
            .animated-text {
                font-size: 18px;
            }

            .subtitle {
                font-size: 16px;
            }

            .top-banner img {
                max-height: 70px;
            }
            
            .notice-message {
                font-size: 14px;
            }
            
            .custom-d .animated-text {
                font-size: 16px !important;
            }
            
            .custom-d .subtitle {
                font-size: 9px !important;
            }
        }

        @media (max-width: 576px) {
            .top-banner {
                text-align: center;
            }

            .animated-text {
                font-size: 16px;
            }

            .subtitle {
                font-size: 14px;
            }

            .top-banner img {
                max-height: 50px;
                margin-bottom: 10px;
            }

            .btn-success {
                display: block;
                margin: 10px auto 0;
            }
            
            .custom-display {
                display: none !important;
            }
            
            .login-button {
                display: none !important;
            }
        }

        @media (max-width: 506px) {
            .custom-d {
                text-align: start;
            }
        }

        @media (min-width: 506px) {
            .login-button-small {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .custom-display {
                display: flex !important;
            }
        }

        /* College info text size adjustments */
        .custom-d p {
            margin-bottom: 0.25rem !important;
        }

        .custom-d .animated-text {
            font-size: 18px !important;
        }

        .custom-d .subtitle {
            font-size: 10px !important;
        }

        /* Contact info adjustments */
        .custom-display {
            font-size: 13px !important;
        }

        @media (max-width: 991px) {
            .custom-display {
                font-size: 12px !important;
            }
        }
    </style>
</head>

<body>
   <header class="header header-lg">
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrap">

                    <div class="notice-container header-top-right">
                        <div class="notice-wrapper">
                            <div class="notice-content">
                                <div class="notice-message">
                                    <span class="new-badge">New</span><strong>Important Notice:</strong>
                                    Sample notice text for demonstration
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-top-left">
                        <div class="header-top-social">
                            <span>Follow Us: </span>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container-fluid bg-white border-bottom">
            <div class="row align-items-center py-2">
                <!-- Logo and College Info - Takes 8 columns on large screens -->
               <div class="col-12 col-lg-8 d-flex align-items-center mb-2 mb-lg-0">
    <img src="images/logo-college.png" alt="ahttc" class="img-fluid" style="width: 7rem; height: 136px;">
    
    <div class="ms-3 d-flex flex-column justify-content-center text-center w-100">
        <p class="mb-0 fw-bold" style="font-size: 20px; color: #198754;">
            AL-HABEEB TEACHERS' TRAINING COLLEGE
        </p>
        <p class="mb-0 fw-semibold" style="font-size: 20px; color: #198754; word-spacing: 8px; letter-spacing: 1px;">
            अल-हबीब टीचर्स ट्रेनिंग कॉलेज
        </p>
        <p class="mb-0 fw-semibold" style="font-size: 20px; color: #198754;">
        ESTD 1987
        </p>
       <p class="mb-0 fw-semibold text-secondary" style="font-size: 17px; color: #2f4f4f; text-align: justify; max-width: 850px; margin: 0 auto; line-height: 1.6;">
    Approved by NCTE, Bhubaneswar | Permanently Affiliated with Binod Bihari Mahto Koylanchal University, Dhanbad | NAAC Accredited
</p>

    </div>
</div>

                <!-- Contact Info and Login Button - Takes 4 columns on large screens -->
                <div class="col-12 col-lg-4">
                    <div class="row align-items-center">
                        <!-- Contact Info -->
                        <div class="col-12 col-md-8 custom-display mb-2 mb-md-0" style="font-size: 15px;">
                            <div class="d-flex flex-column">
                                <div class="mb-1">
                                    <a href="mailto:ahttcbokaro@gmail.com" class="text-decoration-none text-muted">
                                        <i class="bi bi-envelope me-1"></i> ahttcbokaro@gmail.com
                                    </a>
                                </div>
                                <div>
                                    <a href="tel:+916542266103" class="text-decoration-none text-muted">
                                        <i class="bi bi-telephone me-1"></i> +91-6542266103, +91-8877164867
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Login Button -->
                        <div class="col-12 col-md-4 login-button">
                            <a href="https://www.bbmkuniv.in/login" target="_blank" class="btn btn-success btn-sm w-100 text-nowrap">Student Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <!-- Mobile menu header -->
                    <div class="d-flex justify-content-between w-100 d-lg-none">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="login-button-small">
                            <a href="https://www.bbmkuniv.in/login" target="_blank" class="btn btn-success btn-sm">Student Login</a>
                        </div>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <div class="collapse navbar-collapse" id="main_nav">
                        <div class="w-100 d-lg-flex justify-content-between align-items-center">
                            <!-- Main Navigation Items -->
                            <ul class="navbar-nav flex-grow-1">
                                <!-- Navigation Items arranged with proper Bootstrap grid -->
                                <li class="nav-item">
                                    <a class="nav-link single active" href="index.php">HOME</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="about.php" data-bs-toggle="dropdown">ABOUT US</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="about.php?id=abt">About Us</a></li>
                                        <li><a class="dropdown-item" href="about.php?id=ms">Mission & Vision</a></li>
                                        <li><a class="dropdown-item" href="about.php?id=dme">Director's Message</a></li>
                                        <li><a class="dropdown-item" href="about.php?id=map">College Map</a></li>
                                        <li><a class="dropdown-item" href="about.php?id=hol-list">Holiday List</a></li>
                                        <li><a class="dropdown-item" href="about.php?id=aff">Affliation</a></li>
                                        <!--<li><a class="dropdown-item" href="about.php?id=fac">Faculty</a></li>-->
                                    </ul>
                                </li>
                                      <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">ACADEMICS</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Courses</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="student.php?id=bed">B.Ed.</a></li>
                                                <li><a class="dropdown-item" href="student.php?id=deled">D.El.Ed.</a></li>
                                            </ul>
                                        </li>
                                      
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Syllabus</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="student.php?id=bed">B.Ed.</a></li>
                                                <li><a class="dropdown-item" href="student.php?id=deled">D.El.Ed.</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Fees Structure</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="student.php?id=bed">B.Ed.</a></li>
                                                <li><a class="dropdown-item" href="student.php?id=deled">D.El.Ed.</a></li>
                                            </ul>
                                        </li>
                                         
                                        <li><a class="dropdown-item" href="academics.php?id=academic_calendar">Academic Calendar</a></li>
                                        <li><a class="dropdown-item" href="academics.php?id=how">How to Apply</a></li>
                                        <li><a class="dropdown-item" href="academics.php?id=intake">Intake</a></li>
                                        <li><a class="dropdown-item" href="academics.php?id=examination">Examination Cell</a></li>
                                    </ul>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">ADMINISTRATION</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="facilities.php?id=nodal">Nodal Officers</a></li>
                                         <li><a class="dropdown-item" href="facilities.php?id=coord">Coordinators</a></li>
                                        
                                        <!--<li><a class="dropdown-item" href="facilities.php?id=adm_lib">Administrative & Library Staff</a></li>-->
                                        <li><a class="dropdown-item" href="facilities.php?id=teaching">Teaching Staff</a></li>
                                          <li><a class="dropdown-item" href="facilities.php?id=non-teaching">Non-Teaching  Staff</a></li>
                                        <li><a class="dropdown-item" href="facilities.php?id=conference">Conference</a></li>
                                        <li><a class="dropdown-item" href="facilities.php?id=workshop">Workshop and Seminar</a></li>
                                        <li><a class="dropdown-item" href="facilities.php?id=infrastructure">Infrastructure</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">NAAC</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="iqac.php">cycle-2-aqar1</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link single" href="ncte.php">NCTE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link single" href="notice.php?id=all">NOTICES</a>
                                </li>
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link single" href="notices.php">STUDENTS</a>-->
                                <!--</li>-->
                                
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">STUDENTS</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="student.php?id=all"> Students</a></li>
                                        <li><a class="dropdown-item" href="student.php?id=list">List of students</a></li>
                                    </ul>
                                </li>
                          
                            
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">MANDATORY DISCLOSURE</a>
                                    <ul class="dropdown-menu">
                                          <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Library</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="student.php?id=book">About Library</a></li>
                                                <li><a class="dropdown-item" href="student.php?id=ebook">Ebook</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="downloads.php">Downloads</a></li>
                                             <li><a class="dropdown-item" href="affidavit.php">Affidavit</a></li>
                                        <li><a class="dropdown-item" href="rulesRegulation.php">Rules & Regulations</a></li>
                                        <li><a class="dropdown-item" href="news.php">News & Events</a></li>
                                    </ul>
                                </li>
                                
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Events/Activity</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
                                        <li><a class="dropdown-item" href="event_gallery.php">Event Wise Photos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">HELP DESK</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                                      <li><a class="dropdown-item" href="academics.php?id=feedback">Feedback</a></li>
                                        <li><a class="dropdown-item" href="academics.php?id=query">Query</a></li>
                                    </ul>
                                </li>
                            
                                
                            </ul>
                            
                            <!-- Apply Now Button - Separate container for better control -->
                            <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                                <a href="apply.php" class="apply-now-btn">
                                    <i class="bi bi-pencil-square"></i>
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybFbXQ1Eu9OB1A4L7HMT+Z8I6Mp1lbOeC1V7hjAFdOuNfyu5D" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0ey6aAt3A4O2oVRQa0zJCAENj1p11p5A/75UyCOmcuCzK5R4OH1zI6w+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const navbar = document.querySelector('.main-navigation');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                navbar.classList.add('fixed-top');
            } else {
                navbar.classList.remove('fixed-top');
            }
        });

        const currentPath = window.location.pathname.toLowerCase();
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href').toLowerCase();
            link.classList.remove('active');
            if (currentPath.includes(linkPath)) {
                link.classList.add('active');
            }
        });

        // Enhanced dropdown functionality for submenus
        document.querySelectorAll('.dropdown-submenu').forEach(function(element) {
            element.addEventListener('mouseenter', function() {
                let submenu = this.querySelector('.dropdown-menu');
                if (submenu) {
                    submenu.style.display = 'block';
                }
            });
            
            element.addEventListener('mouseleave', function() {
                let submenu = this.querySelector('.dropdown-menu');
                if (submenu) {
                    submenu.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>