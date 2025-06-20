<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>AHTTC|FACILITIES</title>

   
    <style>
       
    body {
    font-family: var(--body-font);
    font-style: normal;
    font-size: 16px;
    font-weight: 400;
    color: var(--body-text-color);
    line-height: 1.8;
}
    </style>


</head>

<body>
<?php
    require 'components/nav.php';
?>
    <div class="site-breadcrumb" style="background: url(./images/home-bg-5.png)">
        <div class="container">
            <h2 class="breadcrumb-title">Our Facilities</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index"class="text-decoration-none">Home</a></li>
                <li class="active">facilities</li>
            </ul>
        </div>
    </div>
   
    <?php
  
    $id = isset($_GET['id']) ? $_GET['id'] : 'default';

    
    switch($id) {
        case 'classroom':
            require 'facilities/classroom.php';  
            break;
        case 'library':
            require 'facilities/library.php';  
            break;
        case 'secretary':       
            require 'facilities/secretary.php';  
            break;
        case 'principal':
            require 'facilities/principal.php';  
            break;
        case 'adm_lib':
            require 'facilities/adm_lib.php';  
            break;
        case 'nodal':
            require 'facilities/nodal.php';  
            break;
            case 'coord':
            require 'facilities/coordinator.php';  
            break;
        case 'open':
            require 'facilities/open.php'; 
            break;
        case 'multi':
            require 'facilities/multimedia.php'; 
            break;
        case 'computer':
            require 'facilities/computer.php'; 
            break;
        case 'psychology': 
            require 'facilities/psychology.php'; 
            break;
        case 'teaching':
            require 'facilities/teaching-staff.php'; 
            break;
             case 'non-teaching':
            require 'facilities/non-teaching-staff.php'; 
            break;
        case 'instruct':
            require 'facilities/instructional.php'; 
            break;     
        case 'conference':
            require 'facilities/conference.php'; 
            break;       
         case 'workshop':
            require 'facilities/workshop.php'; 
            break;    
         case 'skill':
            require 'facilities/skilled_lectures.php'; 
            break;    
         case 'placementcell':
            require 'facilities/placement_cell.php'; 
            break;    
         case 'infrastructure':
            require 'facilities/infrastructure.php'; 
            break;    
                         
        default:
            
            break;
    }
    ?>


<!-- <div class="facility-area py-120  bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline d-inline-block mb-2 text-uppercase " style="font-size: 14px;"><i class="fas fa-book-open-reader"></i> Our Facilities</span>
                            <h2 class="site-title fw-bold" style="font-size: 2.5rem; line-height: 1.4;">Let's Check Our <span>Facilities</span></h2>
                            <p class="text-muted" style="font-size: 1rem; line-height: 1.8; margin-top: 15px;">It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="facility-img">
                                <img src="images/lib.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-title fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="facilities.php?id=library" class="text-dark text-decoration-none">Library Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our library provides a vast collection of books, journals, and digital resources to support learning and exploration.
                                </p>
                                <div class="facility-arrow">
                                    <a href="index" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInDown" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInDown;">
                            <div class="facility-img">
                                <img src="images/classroom.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-title fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="facilities.php?id=classroom" class="text-dark text-decoration-none">Classroom Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our classrooms are designed to foster effective learning, equipped with modern technology and comfortable seating
                                </p>
                                <div class="facility-arrow">
                                    <a href="index" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="facility-img">
                                <img src="images/conference.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-title fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="facilities.php?id=conference" class="text-dark text-decoration-none">Conference Hall Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our conference hall offers a professional setting with state-of-the-art audiovisual facilities
                                </p>
                                <div class="facility-arrow">
                                    <a href="index" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="facility-img">
                                <img src="images/infra.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-titl fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="facilities.php?id=infrastructure" class="text-dark text-decoration-none">infrastructure Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our infrastructure boasts state-of-the-art facilities designed to support learning and innovation
                                </p>
                                <div class="facility-arrow">
                                    <a href="index" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInDown" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInDown;">
                            <div class="facility-img">
                                <img src="images/lab.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-title fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="facilities.php?id=computer" class="text-dark text-decoration-none">Lab Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our labs are equipped with cutting-edge technology to support practical learning and experimentation
                                </p>
                                <div class="facility-arrow">
                                    <a href="index" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="facility-item wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="facility-img">
                                <img src="images/workshop.png" alt="Al-Habeeb Teacher Training College">
                            </div>
                            <div class="facility-content">
                                <h3 class="facility-title fw-bold mb-2" style="font-size: 1.5rem;">
                                    <a href="#" class="text-dark text-decoration-none">Workshop Facility</a>
                                </h3>
                                <p class="facility-text text-muted mb-3" style="font-size: 1rem; line-height: 1.6;">
                                Our workshops offer a dynamic space for skill development and hands-on training. Equipped with modern tools, designed to nurture technical expertise
                                </p>
                                <div class="facility-arrow">
                                    <a href="facilities.php?id=workshop" class="theme-btn fw-semibold" style="font-size: 0.9rem; text-decoration: none;">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

      
   
    <?php require 'components/footer.php'; ?>
   
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
   
    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>
  

</body>

</html>