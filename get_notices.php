<?php
require "db/db.php";


$sql = "SELECT title, link, content FROM notices ORDER BY created_at DESC";
$result = $conn->query($sql);

$notices = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notices[] = $row;
    }
}

$conn->close();
?>
