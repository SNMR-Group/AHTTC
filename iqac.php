<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | IQAC - AQAR</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
  <style>
      body {
          background: linear-gradient(to right, #0f4c29, #1b733a);
          color: #fff;
          font-family: 'Poppins', sans-serif;
      }
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
      span{
        color:white;
      }
  </style>
</head>

<body>
  <?php require 'components/nav.php'; ?>

  <div class="site-breadcrumb text-center p-120" style="background: url(./images/home-bg-1.png) no-repeat center; background-size: cover;">
    <div class="container">
      <h2 class="breadcrumb-title">IQAC - AQAR</h2>
      <ul class="breadcrumb-menu list-unstyled d-flex justify-content-center">
        <li><a href="index.php" class="text-decoration-none">Home</a></li>
        <li class="active">IQAC - AQAR</li>
      </ul>
    </div>
  </div>

  <div class="downloads-container" data-aos="fade-up">
      <h2 class="text-center mb-4" style="color: #66ff99;">NAAC & IQAC Documents</h2>
      
      <?php 
      $documents = [
          "List of Admitted Student B.Ed 2021-23" => "downloads/admitted_students_21_23.pdf",
          "List of Admitted Students 22-24" => "downloads/admitted_students_22_24.pdf",
          "Student Satisfaction Survey" => "downloads/student_satisfaction_survey.pdf",
          "Prospectus B.Ed 2021-23" => "downloads/prospectus_21_23.pdf",
          "Balance Sheet 22-23" => "downloads/balance_sheet_22_23.pdf",
          "Income & Expenditure 22-23" => "downloads/income_expenditure_22_23.pdf",
          "Audit Reports for 2020-21" => "downloads/audit_report_2020_21.pdf",
          "List of Faculty" => "downloads/faculty_list.pdf",
          "Library Information" => "downloads/library_info.pdf",
          "NCTE Web Link" => "downloads/ncte_web_link.pdf",
          "Sanctioned Programme" => "downloads/sanctioned_programme.pdf",
          "IQAC Meeting AQAR-2 (2023-24)" => "downloads/aqar_2.pdf"
      ];
      
      foreach ($documents as $title => $file) {
          echo "<div class='download-item' data-aos='fade-right'>
                  <span>$title</span>
                  <a href='$file' download>
                      <i class='fas fa-download'></i> Download
                  </a>
                </div>";
      }
      ?>
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
