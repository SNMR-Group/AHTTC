<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>AHTTC|FACILITIES</title>

   
    <style>
       
    body {
    font-family: var(--body-font);
    font-style: normal;
    font-size: 16px;
    font-weight: 400;
    color: var(--body-text-color);
    line-height: 1.8;
}
    </style>


</head>

<body>
<?php
    require 'components/nav.php';
?>
    <div class="site-breadcrumb" style="background: url(./images/home-bg-5.png)">
        <div class="container">
            <h2 class="breadcrumb-title">Welcome to ebook section</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index"class="text-decoration-none">Home</a></li>
                <li class="active">E-book</li>
            </ul>
        </div>
    </div>

    <section class="ebook-section" style="padding: 40px; background-color: #e6f4ea; text-align: center;">
    <h1 style="color: #2e7d32; font-weight: bold;">Explore Our E-Book Collection</h1>
    <p style="color: #388e3c; font-size: 18px;">A handpicked selection of books for you.</p>

    <div class="book-grid" id="bookGrid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; justify-items: center;">
        <div class="book-card" onclick="showModal('The Green Mystery', 'John Doe', 'https://source.unsplash.com/200x300/?book,green')" 
             style="background: #c8e6c9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer; transition: transform 0.3s ease;">
            <img src="https://source.unsplash.com/200x300/?book,green" alt="Al-Habeeb Teacher Training College" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            <h3 style="color: #2e7d32; margin: 10px 0;">The Green Mystery</h3>
            <p style="color: #388e3c;">By John Doe</p>
        </div>
        
        <div class="book-card" onclick="showModal('Nature’s Code', 'Jane Smith', 'https://source.unsplash.com/200x300/?forest,book')" 
             style="background: #c8e6c9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer; transition: transform 0.3s ease;">
            <img src="https://source.unsplash.com/200x300/?forest,book" alt="Al-Habeeb Teacher Training College" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            <h3 style="color: #2e7d32; margin: 10px 0;">Nature’s Code</h3>
            <p style="color: #388e3c;">By Jane Smith</p>
        </div>

        <div class="book-card" onclick="showModal('Emerald Wisdom', 'Robert Lee', 'https://source.unsplash.com/200x300/?book,nature')" 
             style="background: #c8e6c9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer; transition: transform 0.3s ease;">
            <img src="https://source.unsplash.com/200x300/?book,nature" alt="Al-Habeeb Teacher Training College" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            <h3 style="color: #2e7d32; margin: 10px 0;">Emerald Wisdom</h3>
            <p style="color: #388e3c;">By Robert Lee</p>
        </div>

        <div class="book-card" onclick="showModal('The Secret Garden', 'Emily Clark', 'https://source.unsplash.com/200x300/?garden,book')" 
             style="background: #c8e6c9; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer; transition: transform 0.3s ease;">
            <img src="https://source.unsplash.com/200x300/?garden,book" alt="Al-Habeeb Teacher Training College" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            <h3 style="color: #2e7d32; margin: 10px 0;">The Secret Garden</h3>
            <p style="color: #388e3c;">By Emily Clark</p>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="bookModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); justify-content: center; align-items: center;">
        <div class="modal-content" style="background: white; padding: 20px; border-radius: 10px; text-align: center; width: 300px;">
            <h2 id="modalTitle"></h2>
            <p id="modalAuthor"></p>
            <img id="modalImage" src="" alt="Book Cover" style="width: 100%; border-radius: 5px;">
            <button class="close-btn" onclick="closeModal()" style="background: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; margin-top: 10px; border-radius: 5px;">Close</button>
        </div>
    </div>
</section>

   
    <?php require 'components/footer.php'; ?>
   
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
   
    <script src="https://kit.fontawesome.com/93db5551bb.js" crossorigin="anonymous"></script>

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
</body>

</html>