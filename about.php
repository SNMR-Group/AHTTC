<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>AHTTC | About</title>
    <link rel="shortcut icon" href="images/logo-college.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>


<body>

    <?php
    require 'components/nav.php';  
    ?>

    <div class="site-breadcrumb" style="background: url(images/about-ah.png)">
        <div class="container">
            <h2 class="breadcrumb-title">About</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="active">About</li>
            </ul>
        </div>
    </div>

    <?php
   
    $id = isset($_GET['id']) ? $_GET['id'] : 'default';

  
    switch ($id) {
        case 'abt':
            require 'about/about-us.php';
            break;
        case 'ms':
            require 'about/mission&vision.php';
            break;
        case 'aff':
            require 'about/affliation.php';
            break;
        case 'rec':
            require 'about/recognition.php';
            break;
        case 'dme':
            require 'about/director-message.php';
            break;
        case 'fac':
            require 'about/faculty.php';
            break;
        case 'map':
            require 'about/map.php';
            break;
        case 'hol-list':
            require 'about/hol-list.php';
            break;
        
      
        default:
            echo "<section id='default'>
                    <h1>Default Section</h1>
                    <p>No specific ID found, showing the default section.</p>
                  </section>";
            break;
    }

    
    ?>

    <?php
  
    require 'components/footer.php';
    require 'components/scrollup.php';
    ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>

</body>

</html>