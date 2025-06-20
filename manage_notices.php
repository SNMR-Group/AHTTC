<?php
require "db/db.php";

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        addNotice($conn);
        break;
    case 'edit':
        editNotice($conn);
        break;
    case 'update':
        updateNotice($conn);
        break;
    case 'delete':
        deleteNotice($conn);
        break;
    default:
        // Fetch notices for display
        fetchNotices($conn);
        break;
}

function addNotice($conn) {
    $title = $_POST['title'] ?? '';
    $link = $_POST['link'] ?? '';

    if ($title && $link) {
        $stmt = $conn->prepare("INSERT INTO notices (title, link, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $link);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error adding notice.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Title and link are required.']);
    }
}

function editNotice($conn) {
    $id = $_GET['id'] ?? '';

    if ($id) {
        $stmt = $conn->prepare("SELECT id, title, link FROM notices WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $notice = $result->fetch_assoc();
        $stmt->close();
        if ($notice) {
            echo json_encode($notice);
        } else {
            echo json_encode(['error' => 'Notice not found.']);
        }
    } else {
        echo json_encode(['error' => 'ID is required.']);
    }
}

function updateNotice($conn) {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $link = $_POST['link'] ?? '';

    if ($id && $title && $link) {
        $stmt = $conn->prepare("UPDATE notices SET title = ?, link = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $link, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error updating notice.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID, title, and link are required.']);
    }
}

function deleteNotice($conn) {
    $id = $_GET['id'] ?? '';

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM notices WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error deleting notice.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID is required.']);
    }
}

function fetchNotices($conn) {
    $sql = "SELECT id, title, link FROM notices ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $notices = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $notices[] = $row;
        }
    }
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($notices);
}
?>
