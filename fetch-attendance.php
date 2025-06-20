<?php
require "./db/db.php";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; 
$offset = ($page - 1) * $limit;


$sql = "SELECT * FROM attendance ORDER BY upload_date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}


$countResult = $conn->query("SELECT COUNT(*) AS total FROM attendance_records");
$total = $countResult->fetch_assoc()['total'];


echo json_encode([
    'records' => $records,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);

$conn->close();
?>
