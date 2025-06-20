<?php
require "./db/db.php";
// Get page and limit from request
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Fetch records with pagination
$sql = "SELECT * FROM merit_list ORDER BY upload_date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

// Get total records count
$countResult = $conn->query("SELECT COUNT(*) AS total FROM merit_list");
$total = $countResult->fetch_assoc()['total'];

// Return JSON response
echo json_encode([
    'records' => $records,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);

$conn->close();
?>
