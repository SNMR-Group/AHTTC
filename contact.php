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

</head>

<body>
  <?php
  require 'components/nav.php';
  ?>

  
  <div class="site-breadcrumb" style="background: url(./images/home-bg-1.png)">
    <div class="container">
      <h2 class="breadcrumb-title">Contact</h2>
      <ul class="breadcrumb-menu">
        <li><a href="index.php" class="text-decoration-none">Home</a></li>
        <li class="active">Contact</li>
      </ul>
    </div>
  </div>



  <div class="contact-area py-120">
    <div class="container">
      <div class="contact-content">
        <div class="row">
          <div class="col-md-3">
            <div class="contact-info">
              <div class="contact-info-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="contact-info-content">
                <h5>Address</h5>
                <p>(Sector-VI, Block-Chas, Bokaro Steel City, Jharkhand-827006)</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contact-info">
              <div class="contact-info-icon">
                <i class="fas fa-phone-volume"></i>
              </div>
              <div class="contact-info-content">
                <h5>Call Us</h5>
                <p>+91-6542266103,+91-8877164867</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contact-info">
              <div class="contact-info-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="contact-info-content">
                <h5>Email Us</h5>
                <p>ahttcbokaro@gmail.com</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contact-info">
              <div class="contact-info-icon">
                <i class="bi bi-alarm-fill"></i>
              </div>
              <div class="contact-info-content">
                <h5>Open Time</h5>
                <p>Mon - Fri (09.50AM - 03.00PM)</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="contact-wrapper">
        <div class="row">
          <div class="col-lg-5">
            <div class="contact-img">
              <img src="images/contact.png" alt="Al-Habeeb Teacher Training College">
            </div>
          </div>
          <div class="col-lg-7 align-self-center">
            <div class="contact-form">
              <div class="contact-form-header">
                <h2>Get In Touch</h2>
                <p>Let's Connect together and make teachers for the upcoming India </p>
              </div>
              <form method="post" action="contact-handler.php" id="contact-form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="name" placeholder="Your Name" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Your Subject" required="">
                </div>
                <div class="form-group">
                  <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message"></textarea>
                </div>
                <button type="submit" class="theme-btn">Send
                  Message <i class="far fa-paper-plane"></i></button>
                <div class="col-md-12 mt-3">
                  <div class="form-messege text-success"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 


  <div class="contact-map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.7487573309063!2d86.17406217438942!3d23.684941191287972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f42189be2918db%3A0xb7205bc152798bfe!2sAl-Habeeb%20Teacher%20Training%20College!5e0!3m2!1sen!2sin!4v1740038327004!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  



  <?php require 'components/footer.php'; ?>

  <?php
  require 'components/scrollup.php';
  ?>

</body>

</html>