<?php
// Include database connection
try {
    require 'db/db.php';
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all active documents
$documents = [];
$error_message = '';

try {
    $sql = "SELECT id, title, file_path FROM downloadable_docs WHERE status = 'active' ORDER BY created_at DESC"; 
    $result = $conn->query($sql);
    
    if ($result) {
        $documents = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error_message = "Error fetching documents: " . $conn->error;
    }
} catch (Exception $e) {
    $error_message = "Database error: " . $e->getMessage();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | Downloads</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
      .downloads-container {
          padding: 30px;
          background: rgba(255, 255, 255, 0.1);
          border-radius: 15px;
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
          margin: 50px auto;
          max-width: 800px;
          backdrop-filter: blur(10px);
      }
      .download-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 15px;
          border-bottom: 1px solid rgba(255, 255, 255, 0.2);
          transition: transform 0.3s ease-in-out;
      }
      .download-item:hover {
          transform: translateY(-5px);
      }
      .download-item a {
          color: #66ff99;
          text-decoration: none;
          font-weight: 500;
          transition: color 0.3s ease-in-out;
      }
      .download-item a:hover {
          color: #fff;
          text-decoration: underline;
      }
      .download-item i {
          color: #66ff99;
      }
      .breadcrumb-menu a {
          color: #66ff99;
      }
      span{
        color: white;
      }
      .downloads-container {
          background-color: #198754;
      }
  </style>
</head>

<body>
  <?php require 'components/nav.php'; ?>

  <div class="site-breadcrumb text-center p-120" style="background: url(./images/home-bg-1.png) no-repeat center; background-size: cover;">
    <div class="container">
      <h2 class="breadcrumb-title">Downloads</h2>
      <ul class="breadcrumb-menu list-unstyled d-flex justify-content-center">
        <li><a href="index.php" class="text-decoration-none">Home</a></li>
        <li class="active">Downloads</li>
      </ul>
    </div>
  </div>

  <div class="downloads-container" data-aos="fade-up">
      <h2 class="text-center mb-4" style="color: #66ff99;">Downloadable Documents</h2>
      <?php if (!empty($error_message)): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
      <?php endif; ?>
      
      <?php if (empty($documents)): ?>
          <div class="alert alert-info">No documents available for download at this time.</div>
      <?php else: ?>
          <?php foreach ($documents as $index => $document): ?>
              <div class="download-item" data-aos="<?php echo $index % 2 === 0 ? 'fade-right' : 'fade-left'; ?>">
                  <span><?php echo htmlspecialchars($document['title']); ?></span>
                  <a href="<?php echo htmlspecialchars($document['file_path']); ?>" download>
                      <i class="fas fa-download"></i> Download
                  </a>
              </div>
          <?php endforeach; ?>
      <?php endif; ?>
  </div>

  <?php require 'components/footer.php'; ?>
  <?php require 'components/scrollup.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init({ duration: 1000 });
  </script>
</body>
</html>