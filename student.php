<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHTTC | Student</title>
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
            <h2 class="breadcrumb-title">Student</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="active">Student</li>
            </ul>
        </div>
    </div>

    <?php
   
    $id = isset($_GET['id']) ? $_GET['id'] : 'default';

   
    switch ($id) {
        case 'sAt':
            require 'student/studentAttendance.php';
            break;
        case 'tAt':
            require 'student/teacherAttendance.php';
            break;
        case 'bed':
            require 'student/bedSyllabus.php';
            break;
        case 'med':
            require 'student/medSyllabus.php';
            break;
        case 'deled':
            require 'student/deledSyllabus.php';
            break;
        case 'attendance':
            require 'student/attendance.php';
            break;
        case 'all':
            require 'student/all_student.php';
            break;
         case 'list':
            require 'student/all_student_list.php';
            break;
            
        case 'attendancerules':
            require 'student/attendanceRules.php';
            break;
        case 'results':
            require 'student/results.php';
            break;
        case 'scholarship':
            require 'student/scholarship.php';
            break;
        case 'placementcell':
            require 'student/placementCell.php';
            break;
        case 'book':
            require 'student/book_library.php';
            break;

         case 'ebook':
                require 'student/ebook.php';
                break;
                
        // case 'student':
        //     require 'student/students.php'
        //     break;
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