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
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
   
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">





    <title>AHTTC | Academics</title>

 
 

</head>

<body>

  
    <?php
    require 'components/nav.php';
    ?>


   
    <div class="site-breadcrumb" style="background: url(./images/acdemic.png)">
        <div class="container">
            <h2 class="breadcrumb-title">Academic Department </h2>
            <ul class="breadcrumb-menu">
                <li><a href="index"class="text-decoration-none">Home</a></li>
                <li class="active">Academic Department</li>
            </ul>
        </div>
    </div>
 
    <?php
  
    $id = isset($_GET['id']) ? $_GET['id'] : 'default';

  
    switch($id) {
        case 'adm':
            require 'academics/admission.php';  
            break;
      
        case 'elg':
            require 'academics/eligibility.php'; 
            break;
        case 'how':
            require 'academics/how.php'; 
            break;
        case 'intake':
            require 'academics/intake.php'; 
            break;
        case 'feedback':
            require 'academics/feedback.php'; 
            break;
             case 'query':
            require 'academics/query.php'; 
            break;
        case 'reservation':
            require 'academics/reservation.php'; 
            break;
        case 'examination':
            require 'academics/examination.php'; 
            break;     
        case 'academic_calendar':
            require 'academics/academic.php'; 
            break;        
        case 'college':
            require 'academics/coll_att.php'; 
            break;        
        default:
            echo "<section id='default'>
                    <h1>Default Section</h1>
                    <p>No specific ID found, showing the default section.</p>
                  </section>";
            break;
    }
    ?>
    
    <?php require 'components/footer.php'; ?>
  


   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   

</body>

</html>