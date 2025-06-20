<?php
ob_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "rgmttc"; 
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$records_per_page = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


$offset = ($page - 1) * $records_per_page;

$category = isset($_GET['category']) ? $_GET['category'] : 'student';

$sql = "SELECT id, title, url FROM attendance 
        WHERE category = ? 
        ORDER BY upload_date DESC 
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $category, $records_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();


$attendanceData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[] = $row;
    }
} else {
    $attendanceData = [];
}

$sql_total = "SELECT COUNT(*) AS total_records FROM attendance WHERE category = ?";
$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param("s", $category);
$stmt_total->execute();
$total_result = $stmt_total->get_result();
$total_records = $total_result->fetch_assoc()['total_records'];
$total_pages = ceil($total_records / $records_per_page);


$conn->close();
?>


<section>
    <div id="attendance-section" class="container my-5">
        <h2 class="text-center mb-4">Student Attendance Records</h2>

        
       

        <?php if (!empty($attendanceData)): ?>
            <?php foreach ($attendanceData as $index => $item): ?>
                <div class="attendance-card mb-4 <?php echo $index % 2 === 0 ? 'left' : 'right'; ?>">
                    <h3 class="attendance-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p>
                        <a href="<?php echo htmlspecialchars($item['url']); ?>" target="_blank" class="btn btn-primary">View Attendance</a>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No attendance records available for the selected category.</p>
        <?php endif; ?>

        
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?id=attendance&category=<?php echo htmlspecialchars($category); ?>&page=<?php echo $page - 1; ?>" class="btn btn-secondary">Previous</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?id=attendance&category=<?php echo htmlspecialchars($category); ?>&page=<?php echo $page + 1; ?>" class="btn btn-secondary">Next</a>
            <?php endif; ?>
        </div>
    </div>
</section>


<style>
  
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

   
    h2.text-center {
        font-size: 2rem;
        color: #333;
    }

    .attendance-card {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

   
    @keyframes fromLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .attendance-card.left {
        animation: fromLeft 1s forwards;
    }

    .attendance-card.right {
        animation: fromRight 1s forwards;
    }

    .attendance-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .attendance-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #444;
    }

   
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

  
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination .btn {
        margin: 0 10px;
    }

  
    .attendance-card p {
        font-size: 1rem;
        color: #666;
    }

    .attendance-card a {
        text-decoration: none;
        color: #fff;
    }
</style>

<?php

ob_end_flush();
?>