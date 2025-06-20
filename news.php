<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | Blog</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }
    .blog-header {
        text-align: center;
        padding: 50px 0;
        background-color: #007bff;
        color: white;
    }
    .blog-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .blog-post {
        margin-bottom: 30px;
    }
    .blog-post img {
        width: 100%;
        border-radius: 10px;
    }
    .blog-post h3 {
        margin-top: 15px;
        color: #343a40;
    }
    .btn-read-more {
        background: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }
    .btn-read-more:hover {
        background: #0056b3;
    }
  </style>
</head>
<body>
  <?php require 'components/nav.php'; ?>

  <div class="site-breadcrumb" style="background: url(images/home-bg-1.png)">
    <div class="container">
        <h2 class="breadcrumb-title">Blog</h2>
        <ul class="breadcrumb-menu">
            <li><a href="index.php" class="text-decoration-none">Home</a></li>
            <li class="active">Blog</li>
        </ul>
    </div>
  </div>

  <div class="container blog-container">
    <div class="blog-post">
      <img src="images/home-bg-2.png" alt="Al-Habeeb Teacher Training College">
      <h3>Title: Independence Day: Celebrating Freedom and National Pride</h3>
      <p>Independence Day reminds us of our duties as responsible citizens. By upholding values of unity, integrity, and progress, we contribute to the nation's development. Let’s celebrate this day with pride and enthusiasm!</p>
      <a href="#" class="btn-read-more">Read More</a>
    </div>

    <div class="blog-post">
      <img src="images/home-bg-4.png" alt="Al-Habeeb Teacher Training College">
      <h3>Teacher's day</h3>
      <p>Teacher’s Day is a celebration of the dedication, wisdom, and guidance that educators provide to shape young minds. It is a day to express gratitude to our mentors who inspire, support, and empower us to achieve our dreams. Teachers not only impart knowledge but also instill values, discipline, and a lifelong love for learning. Their contribution to society is immeasurable, making them the true architects of the future. Let us honor and appreciate their relentless efforts in nurturing generations with wisdom and compassion.</p>
      <a href="#" class="btn-read-more">Read More</a>
    </div>
  </div>


  <?php require 'components/footer.php'; ?>
  <?php require 'components/scrollup.php'; ?>
</body>
</html>

