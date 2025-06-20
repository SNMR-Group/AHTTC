<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxurious E-Book Collection</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>

    <!-- Custom Styling -->
    <style>
        body {
            background: linear-gradient(135deg, #0f3d3e, #1a5e63);
            color: white;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(0, 128, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(90deg, #00ff7f, #009e60);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-size: 1.2rem;
            color: white !important;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #00ff7f !important;
        }

        /* Page Styling */
        .container {
            padding: 50px 20px;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(90deg, #00ff7f, #009e60);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 10px rgba(0, 255, 127, 0.5);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 20px;
            justify-items: center;
        }

        .book-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 255, 127, 0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .book-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 255, 127, 0.5);
        }

        .book-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.2);
        }

        .close-btn {
            background: linear-gradient(90deg, #00ff7f, #009e60);
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .close-btn:hover {
            background: linear-gradient(90deg, #009e60, #00ff7f);
        }

    </style>
</head>

<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">E-Book Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ebook.php"><i class="fas fa-book"></i> E-Book</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- E-Book Section -->
<div class="container">
    <h1><i class="fas fa-book-open"></i> Our E-Book Collection</h1>
    <p>Explore our premium collection of digital books.</p>

    <div class="book-grid">
        <?php
        $books = [
            ["title" => "The Emerald Code", "author" => "John Doe", "image" => "https://source.unsplash.com/250x350/?green,book"],
            ["title" => "Enchanted Forest", "author" => "Emma Stone", "image" => "https://source.unsplash.com/250x350/?nature,book"],
            ["title" => "Wisdom of Trees", "author" => "Mark Twain", "image" => "https://source.unsplash.com/250x350/?forest,book"],
            ["title" => "Secret Garden", "author" => "Sophia Carter", "image" => "https://source.unsplash.com/250x350/?garden,book"],
        ];

        foreach ($books as $book) {
            echo "
                <div class='book-card' onclick=\"showModal('{$book['title']}', '{$book['author']}', '{$book['image']}')\">
                    <img src='{$book['image']}' alt='{$book['title']}'>
                    <h3>{$book['title']}</h3>
                    <p>By {$book['author']}</p>
                </div>
            ";
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="bookModal">
    <div class="modal-content">
        <h2 id="modalTitle"></h2>
        <p id="modalAuthor"></p>
        <img id="modalImage" src="" alt="Al-Habeeb Teacher Training College" style="width: 100%; border-radius: 5px;">
        <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    function showModal(title, author, image) {
        document.getElementById("modalTitle").textContent = title;
        document.getElementById("modalAuthor").textContent = "by " + author;
        document.getElementById("modalImage").src = image;
        document.getElementById("bookModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("bookModal").style.display = "none";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
