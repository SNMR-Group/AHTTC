<?php
include('db/db.php');

$stmt = $conn->prepare("SELECT * FROM extra_notice WHERE category = 'admission' ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$notices = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Admission Notices</h2>

    <div class="row">
        <?php foreach ($notices as $notice): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($notice['title']); ?></h5>
                        <p class="card-text">
                            
                            <a href="<?php echo htmlspecialchars($notice['link']); ?>" class="btn btn-primary" target="_blank">Read More</a>
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <?php echo date('F j, Y', strtotime($notice['created_at'])); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
