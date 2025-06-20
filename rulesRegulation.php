<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | Contact</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>

  .scholarship {
  padding-top: 60px;
  padding-bottom: 60px;
  background-color: #f9f9f9;
}

.scholarship-content h3 {
  font-size: 1.8rem;
  color: #007bff; 
  font-weight: bold;
}

.rules-list {
  list-style-type: none;
  padding-left: 0;
}

.rules-list li {
  position: relative;
  padding: 10px 0;
  padding-left: 30px;
  font-size: 1rem;
  line-height: 1.6;
  color: #555;
  border-bottom: 1px solid #eee;
}

.rules-list li:before {
  content: "✔"; 
  position: absolute;
  left: 0;
  top: 10px;
  color: #007bff; 
  font-size: 1.2rem;
}

.rules-list li:last-child {
  border-bottom: none;
}

.scholarship .container {
  max-width: 900px;
}

.scholarship-content {
  text-align: left;
  background: #fff;
  padding: 20px 30px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.scholarship-content h3 {
  margin-bottom: 20px;
}

.scholarship-content p {
  margin-bottom: 15px;
  font-size: 1rem;
  line-height: 1.6;
  color: #444;
}
</style>

</head>

<body>
  <?php
  require 'components/nav.php';
  ?>

  
  <div class="site-breadcrumb" style="background: url(./images/home-bg-1.png)">
    <div class="container">
      <h2 class="breadcrumb-title">More</h2>
      <ul class="breadcrumb-menu">
        <li><a href="index.php" class="text-decoration-none">Home</a></li>
        <li class="active">More</li>
      </ul>
    </div>
  </div>
  

 
<div class="scholarship pt-120">
  <div class="container">
    <div class="scholarship-content">
      <div class="my-4">
        <h3 class="mb-3 text-primary">Rules & Regulations</h3>
        <ul class="rules-list">
          <li>All students shall abide by the rules and regulations laid down for their discipline and development.</li>
          <li>All students are expected to be in the college premises during the working hours from 9:45 A.M. to 4:30 P.M.</li>
          <li>Students are required to be neatly dressed as provided by the institution.</li>
          <li>Students are required to wear their ID cards at all times within the campus.</li>
          <li>Students should attend the common assembly and participate in all the activities and events of the college. Absence on such occasions will be considered misconduct.</li>
          <li>Students should read the notice board daily to stay updated on the activities of the college.</li>
          <li>Students should maintain regular attendance and punctuality. A minimum of 90% attendance in all subjects is mandatory to be eligible for semester examinations.</li>
          <li>Leave applications should be written in the prescribed format, duly attested by parents/guardians/warden, and submitted to the principal through the Head of the Department by the end of the week.</li>
          <li>Personal mail or visitors during working hours is not permitted for day scholars.</li>
          <li>Requests for seasonal and educational travel concessions from bonafide students must be made to the principal as specified on the notice board.</li>
          <li>Ragging is strictly prohibited on the campus. Students found guilty of ragging will be expelled.</li>
          <li>Students must retain their fee receipts for future verification if required.</li>
          <li>The registrar has the right to ask any student to leave the college and issue a Transfer Certificate at any time for indiscipline, unauthorized absence, or non-payment of fees and dues.</li>
          <li>Parents and guardians must promptly notify any changes in their address.</li>
          <li>Parents must inform the registrar within two weeks if their wards discontinue their studies. Applications for Transfer and Conduct Certificates should be submitted in the prescribed forms available at the registrar’s office.</li>
        </ul>
      </div>
    </div>
  </div>
</div>

  <?php require 'components/footer.php'; ?>

  <?php
  require 'components/scrollup.php';
  ?>

</body>

</html>