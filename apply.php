<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHTTC | Apply Now</title>
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
            <h2 class="breadcrumb-title">Apply Now!</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="active">Apply Now</li>
            </ul>
        </div>
    </div>
   
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Apply Now</h2>
                        <form action="./apply-handler.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="course" class="form-label">Course Interested In</label>
                                <select class="form-select" id="course" name="subject" required>
                                    <option value="" disabled selected>Select a Course</option>
                                    <option value="B.Ed.">B.Ed.</option>
                                    <option value="D.El.Ed.">D.El.Ed.</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Why do you want to join?</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'components/footer.php'; ?>
    <?php require 'components/scrollup.php'; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>-->
</body>

</html>