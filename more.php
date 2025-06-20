<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHTTC | More</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">

</head>

<body>

    <?php
    require 'components/nav.php';  
    ?>

    <div class="site-breadcrumb" style="background: url(images/home-bg-1.png)">
        <div class="container">
            <h2 class="breadcrumb-title">More</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="active">More</li>
            </ul>
        </div>
    </div>

    <?php
   
    $id = isset($_GET['id']) ? $_GET['id'] : 'default';

    
    switch ($id) {
        case 'ai':
            require 'more/aishe.php';
            break;
        case 'par':
            require 'more/par.php';
            break;
        case 'naac':
            require 'more/naac.php';
            break;
        case 'jshes':
            require 'more/jshes.php';
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
</body>

</html>