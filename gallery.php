<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | Gallery</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body {
      background: #ffffff;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }
    .gallery-container {
      padding: 50px 20px;
      max-width: 1200px;
      margin: auto;
      background: rgba(40, 156, 108, 0.9);
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      background: #fff;
      margin-bottom: 30px;
    }
    .gallery-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    }
    .gallery-img {
      position: relative;
      overflow: hidden;
      height: 280px;
    }
    .gallery-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px 15px 0 0;
      transition: all 0.4s ease;
      filter: brightness(90%) saturate(1.1);
    }
    .gallery-item:hover .gallery-img img {
      transform: scale(1.08);
      filter: brightness(100%) saturate(1.2);
    }
    .gallery-content {
      position: relative;
      padding: 20px;
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
      border-radius: 0 0 15px 15px;
      text-align: center;
      transition: all 0.3s ease;
    }
    .gallery-content::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, #289c6c, #34a853);
      border-radius: 2px;
    }
    .gallery-description {
      font-size: 16px;
      font-weight: 500;
      color: #2c3e50;
      margin: 15px 0 0 0;
      line-height: 1.5;
      letter-spacing: 0.3px;
    }
    .gallery-item:hover .gallery-content {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .breadcrumb-menu a {
      color: rgb(19, 24, 71);
    }
    
    /* Alternative overlay style (uncomment to use) */
    /*
    .gallery-item-overlay {
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      transition: all 0.4s ease;
      height: 350px;
    }
    .gallery-item-overlay:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    }
    .gallery-img-overlay {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px;
      transition: all 0.4s ease;
    }
    .gallery-overlay-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
      color: white;
      padding: 40px 20px 25px;
      text-align: center;
      transform: translateY(100%);
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      border-radius: 0 0 15px 15px;
    }
    .gallery-item-overlay:hover .gallery-overlay-content {
      transform: translateY(0);
    }
    .gallery-overlay-title {
      font-size: 18px;
      font-weight: 600;
      margin: 0;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
    */
  </style>
</head>
<body>
  <?php require 'components/nav.php'; ?>
  <div class="site-breadcrumb text-center py-120" style="background: url(./images/home-bg-2.png) no-repeat center; background-size: cover;">
    <div class="container">
      <h2 class="breadcrumb-title">Gallery</h2>
      <ul class="breadcrumb-menu list-unstyled d-flex justify-content-center">
        <li><a href="index.php" class="text-decoration-none">Home</a></li>
        <li class="active">Gallery</li>
      </ul>
    </div>
  </div>
  
  <div class="gallery-container mt-5 mb-5" data-aos="fade-up">
    <h2 class="text-center mb-5" style="color: rgb(15, 15, 15); font-weight: 600; font-size: 2.5rem;">Explore Our Gallery</h2>
    <div class="row">
      <?php
      require "db/db.php";
      $sql = "SELECT * FROM gallery_images";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $imagePath = $row['image_path'];
          $description = $row['description'];
          echo '
          <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="gallery-item">
              <div class="gallery-img">
                <img src="' . $imagePath . '" alt="' . htmlspecialchars($description) . '">
              </div>
              <div class="gallery-content">
                <p class="gallery-description">' . htmlspecialchars($description) . '</p>
              </div>
            </div>
          </div>';
        }
      } else {
        echo '<div class="col-12"><p class="text-center text-white fs-5">No images available in the gallery.</p></div>';
      }
      ?>
    </div>
  </div>
  
  <?php require 'components/footer.php'; ?>
  <?php require 'components/scrollup.php'; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init({ 
        duration: 1000,
        once: true,
        offset: 50
      });
  </script>
</body>
</html>