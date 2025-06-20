<?php
require "db/db.php";

$sql = "SELECT message FROM top_notice ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$notice = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $notice = $row['message'];
} else {
    $notice = "No notices available.";
}

$conn->close();
echo $notice;
?>