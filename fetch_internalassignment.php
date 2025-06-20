<?php
require "./db/db.php";

// Get page and limit from the request
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Validate page and offset values
if ($page < 1) $page = 1;
if ($offset < 0) $offset = 0;

try {
    // Fetch records with pagination
    $stmt = $conn->prepare("SELECT * FROM internal_assignment ORDER BY upload_date DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $records = [];
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    // Get total records count
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM internal_assignment");
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];

    // Return JSON response
    echo json_encode([
        'records' => $records,
        'total' => $total,
        'page' => $page,
        'limit' => $limit
    ]);
} catch (Exception $e) {
    // Handle any exceptions or errors
    echo json_encode([
        'error' => true,
        'message' => 'An error occurred while fetching data.',
        'details' => $e->getMessage()
    ]);
} finally {
    $conn->close();
}
?>
