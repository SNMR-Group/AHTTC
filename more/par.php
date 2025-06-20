<?php

require "db/db.php"; 

$sql = "SELECT title, url FROM par";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGMTTC | PAR</title>
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Click button to see PAR</h2>
        <div class="d-grid gap-2">
            <?php
           
            if ($result->num_rows > 0) {
               
                while($row = $result->fetch_assoc()) {
                    echo "<button onclick=\"window.location.href='" . $row['url'] . "'\" class='btn btn-primary'>" . $row['title'] . "</button>";
                }
            } else {
                echo "<p>No data found</p>";
            }
            ?>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
   
    if ($conn) {
        $conn->close();
    }
    ?>
</body>
</html>
