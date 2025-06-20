<?php
session_start();
require "db/db.php";
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update') {
        $message = $_POST['message'];

        $sql = "UPDATE top_notice SET message = ? WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $message);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = $stmt->error;
        }
        $stmt->close();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'fetch') {
        $sql = "SELECT message FROM top_notice ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $notice = '';

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notice = $row['message'];
        } else {
            $notice = "No notices available.";
        }
        echo json_encode(['message' => $notice]);
        exit;
    }
}

$conn->close();
echo json_encode($response);
