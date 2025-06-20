<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}

require "db/db.php";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_event':
                $event_name = $_POST['event_name'];
                $event_date = $_POST['event_date'];
                $event_description = $_POST['event_description'];
                
                $sql = "INSERT INTO events (event_name, event_date, description) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $event_name, $event_date, $event_description);
                $stmt->execute();
                break;
                
            case 'add_image':
                $event_id = $_POST['event_id'];
                $image_description = $_POST['image_description'];
                
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $upload_dir = "uploads/events/";
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $file_name = uniqid() . '.' . $file_extension;
                    $upload_path = $upload_dir . $file_name;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                        $sql = "INSERT INTO event_gallery (event_id, image_path, description) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iss", $event_id, $upload_path, $image_description);
                        $stmt->execute();
                    }
                }
                break;
                
            case 'bulk_upload':
                $event_id = $_POST['event_id'];
                $default_description = $_POST['default_description'] ?? 'Event Image';
                
                if (isset($_FILES['images'])) {
                    $upload_dir = "uploads/events/";
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    $total_files = count($_FILES['images']['name']);
                    
                    for ($i = 0; $i < $total_files; $i++) {
                        if ($_FILES['images']['error'][$i] == 0) {
                            $file_extension = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                            $file_name = uniqid() . '.' . $file_extension;
                            $upload_path = $upload_dir . $file_name;
                            
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $upload_path)) {
                                $description = $default_description . ' ' . ($i + 1);
                                $sql = "INSERT INTO event_gallery (event_id, image_path, description) VALUES (?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("iss", $event_id, $upload_path, $description);
                                $stmt->execute();
                            }
                        }
                    }
                }
                break;
                
            case 'update_event':
                $event_id = $_POST['event_id'];
                $event_name = $_POST['event_name'];
                $event_date = $_POST['event_date'];
                $event_description = $_POST['event_description'];
                
                $sql = "UPDATE events SET event_name=?, event_date=?, description=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $event_name, $event_date, $event_description, $event_id);
                $stmt->execute();
                break;
                
            case 'update_image':
                $image_id = $_POST['image_id'];
                $image_description = $_POST['image_description'];
                
                $sql = "UPDATE event_gallery SET description=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $image_description, $image_id);
                $stmt->execute();
                break;
        }
    }
}

// Handle GET requests for deletion
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete_event' && isset($_GET['id'])) {
        $event_id = $_GET['id'];
        
        // Delete all images for this event first
        $sql = "SELECT image_path FROM event_gallery WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            if (file_exists($row['image_path'])) {
                unlink($row['image_path']);
            }
        }
        
        $sql = "DELETE FROM event_gallery WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        
        // Delete the event
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
    }
    
    if ($_GET['action'] == 'delete_image' && isset($_GET['id'])) {
        $image_id = $_GET['id'];
        
        // Get image path and delete file
        $sql = "SELECT image_path FROM event_gallery WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row && file_exists($row['image_path'])) {
            unlink($row['image_path']);
        }
        
        $sql = "DELETE FROM event_gallery WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Gallery Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .upload-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }
        .upload-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .image-preview {
            transition: transform 0.3s ease;
        }
        .image-preview:hover {
            transform: scale(1.05);
        }
        .event-card {
            border-left: 5px solid #007bff;
            transition: all 0.3s ease;
        }
        .event-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
     <?php require('admin_sidebar.php') ?>
    <div class="container">
        <div class="container">
            <h1 class="text-center mt-5">Welcome to Event Gallery Management, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        </div>

        <!-- Quick Upload Section -->
        <div class="container mt-5">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h2><i class="fas fa-upload"></i> Quick Image Upload</h2>
                </div>
                <div class="card-body">
                    <?php
                    // Get all events for dropdown
                    $events_dropdown_sql = "SELECT id, event_name, event_date FROM events ORDER BY event_date DESC";
                    $events_dropdown_result = $conn->query($events_dropdown_sql);
                    
                    if ($events_dropdown_result && $events_dropdown_result->num_rows > 0) {
                        echo '<div class="row">
                            <div class="col-md-6">
                                <h5>Single Image Upload</h5>
                                <form method="POST" enctype="multipart/form-data" class="border p-3 rounded">
                                    <input type="hidden" name="action" value="add_image">
                                    <div class="mb-3">
                                        <label class="form-label">Select Event</label>
                                        <select class="form-control" name="event_id" required>
                                            <option value="">Choose an event...</option>';
                        
                        $events_dropdown_result->data_seek(0); // Reset pointer
                        while ($event_option = $events_dropdown_result->fetch_assoc()) {
                            echo '<option value="' . $event_option['id'] . '">' . 
                                 htmlspecialchars($event_option['event_name']) . ' (' . 
                                 date('M j, Y', strtotime($event_option['event_date'])) . ')</option>';
                        }
                        
                        echo '</select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Image</label>
                                        <input type="file" class="form-control" name="image" accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image Description</label>
                                        <input type="text" class="form-control" name="image_description" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-upload"></i> Upload Single Image
                                    </button>
                                </form>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Bulk Image Upload</h5>
                                <form method="POST" enctype="multipart/form-data" class="border p-3 rounded">
                                    <input type="hidden" name="action" value="bulk_upload">
                                    <div class="mb-3">
                                        <label class="form-label">Select Event</label>
                                        <select class="form-control" name="event_id" required>
                                            <option value="">Choose an event...</option>';
                        
                        $events_dropdown_result->data_seek(0); // Reset pointer again
                        while ($event_option = $events_dropdown_result->fetch_assoc()) {
                            echo '<option value="' . $event_option['id'] . '">' . 
                                 htmlspecialchars($event_option['event_name']) . ' (' . 
                                 date('M j, Y', strtotime($event_option['event_date'])) . ')</option>';
                        }
                        
                        echo '</select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Multiple Images</label>
                                        <input type="file" class="form-control" name="images[]" accept="image/*" multiple required>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple images</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Default Description (will be numbered)</label>
                                        <input type="text" class="form-control" name="default_description" value="Event Image" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="fas fa-images"></i> Upload Multiple Images
                                    </button>
                                </form>
                            </div>
                        </div>';
                    } else {
                        echo '<div class="alert alert-warning">
                            <strong>No events available!</strong> Please create an event first before uploading images.
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Event</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="add_event">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_name" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_date" class="form-label">Event Date</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="event_description" class="form-label">Event Description</label>
                            <textarea class="form-control" id="event_description" name="event_description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Create Event</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Events List and Management -->
        <div class="container mt-5">
            <?php
            $events_sql = "SELECT * FROM events ORDER BY event_date DESC";
            $events_result = $conn->query($events_sql);

            if ($events_result && $events_result->num_rows > 0) {
                while ($event = $events_result->fetch_assoc()) {
                    echo '<div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3>' . htmlspecialchars($event['event_name']) . '</h3>
                                <small class="text-muted">Date: ' . date('F j, Y', strtotime($event['event_date'])) . '</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#event-' . $event['id'] . '">
                                    Manage Event
                                </button>
                                <a href="?action=delete_event&id=' . $event['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this event and all its images?\')">
                                    Delete Event
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>' . htmlspecialchars($event['description']) . '</p>
                            
                            <div class="collapse" id="event-' . $event['id'] . '">
                                <!-- Update Event Form -->
                                <div class="border p-3 mb-3 bg-light">
                                    <h5>Update Event Details</h5>
                                    <form method="POST">
                                        <input type="hidden" name="action" value="update_event">
                                        <input type="hidden" name="event_id" value="' . $event['id'] . '">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Event Name</label>
                                                    <input type="text" class="form-control" name="event_name" value="' . htmlspecialchars($event['event_name']) . '" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Event Date</label>
                                                    <input type="date" class="form-control" name="event_date" value="' . $event['event_date'] . '" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Event Description</label>
                                            <textarea class="form-control" name="event_description" rows="3" required>' . htmlspecialchars($event['description']) . '</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Event</button>
                                    </form>
                                </div>
                                
                                <!-- Add Image Form -->
                                <div class="border p-3 mb-3 bg-info bg-opacity-10">
                                    <h5><i class="fas fa-plus-circle"></i> Add Single Image to Event</h5>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="add_image">
                                        <input type="hidden" name="event_id" value="' . $event['id'] . '">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Image</label>
                                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image Description</label>
                                                    <input type="text" class="form-control" name="image_description" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-upload"></i> Upload Image
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Bulk Upload Form -->
                                <div class="border p-3 mb-3 bg-warning bg-opacity-10">
                                    <h5><i class="fas fa-images"></i> Bulk Upload Multiple Images</h5>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="bulk_upload">
                                        <input type="hidden" name="event_id" value="' . $event['id'] . '">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Multiple Images</label>
                                                    <input type="file" class="form-control" name="images[]" accept="image/*" multiple required>
                                                    <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple images at once</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Default Description</label>
                                                    <input type="text" class="form-control" name="default_description" value="' . htmlspecialchars($event['event_name']) . ' Image" required>
                                                    <small class="form-text text-muted">Will be numbered automatically</small>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-cloud-upload-alt"></i> Bulk Upload Images
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Event Images -->
                            <h5>Event Images</h5>
                            <div class="row">';
                    
                    // Get images for this event
                    $images_sql = "SELECT * FROM event_gallery WHERE event_id = " . $event['id'] . " ORDER BY created_at DESC";
                    $images_result = $conn->query($images_sql);
                    
                    if ($images_result && $images_result->num_rows > 0) {
                        while ($image = $images_result->fetch_assoc()) {
                            echo '<div class="col-md-3 mb-3">
                                <div class="card image-preview">
                                    <img src="' . $image['image_path'] . '" class="card-img-top" alt="Event Image" style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block mb-2">Uploaded: ' . date('M j, Y', strtotime($image['created_at'])) . '</small>
                                        <form method="POST" class="mb-2">
                                            <input type="hidden" name="action" value="update_image">
                                            <input type="hidden" name="image_id" value="' . $image['id'] . '">
                                            <div class="mb-2">
                                                <input type="text" class="form-control form-control-sm" name="image_description" value="' . htmlspecialchars($image['description']) . '" required>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary w-100 mb-1">
                                                <i class="fas fa-edit"></i> Update
                                            </button>
                                        </form>
                                        <a href="?action=delete_image&id=' . $image['id'] . '" class="btn btn-sm btn-danger w-100" onclick="return confirm(\'Are you sure you want to delete this image?\')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="col-12"><p class="text-muted">No images uploaded for this event yet.</p></div>';
                    }
                    
                    echo '</div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="alert alert-info">No events created yet. Create your first event above!</div>';
            }
            
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const menuItems = document.querySelectorAll('.side-menu li');

            menuItems.forEach(item => {
                if (item.getAttribute('data-page') === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>