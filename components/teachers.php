<?php
include('db/db.php');
$stmt = $conn->prepare("SELECT * FROM teachers");
$stmt->execute();
$result = $stmt->get_result();
$teachers = $result->fetch_all(MYSQLI_ASSOC);
?>

<style>
    .image-wrapper {
    width: 100%;
    height: 250px; /* Adjust the height as needed */
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-img-top {
    width: 100%; /* Ensures all images stretch to fit */
    height: 100%; /* Ensures all images maintain uniform height */
    object-fit: cover; /* Crops images to fill the container while maintaining aspect ratio */
}

    </style>
<div class="container py-5" data-aos="fade-right">  
    <div class="row g-4">
        <?php foreach ($teachers as $teacher): ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card team-item border-0 shadow-lg h-100">
                    <div class="image-wrapper position-relative">
                        <img src="<?php echo htmlspecialchars($teacher['image_path']); ?>" alt="Al-Habeeb Teacher Training College" class="card-img-top rounded-top">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">
                            <a href="#" class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($teacher['name']); ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted" style="font-size: 1rem; line-height: 1.6;">
                            <small><b>Position:</b> <?php echo htmlspecialchars($teacher['position']); ?></small><br>
                            <?php 
                                $description = htmlspecialchars($teacher['description']);
                                $words = explode(" ", $description);
                                $shortDesc = count($words) > 10 ? implode(" ", array_slice($words, 0, 5)) . '...' : $description;
                            ?>
                            <span class="short-desc"><?php echo $shortDesc; ?></span>
                            <span class="full-desc d-none"><?php echo $description; ?></span>
                            <?php if (count($words) > 10): ?>
                                <a href="#" class="text-primary read-more-btn" data-full-description="<?php echo htmlspecialchars($teacher['description']); ?>">Read more</a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".read-more-btn").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var parent = this.closest(".card-body");
            var shortDesc = parent.querySelector(".short-desc");
            var fullDesc = parent.querySelector(".full-desc");

            if (fullDesc.classList.contains("d-none")) {
                fullDesc.classList.remove("d-none");
                shortDesc.classList.add("d-none");
                this.innerText = "Read less";
            } else {
                fullDesc.classList.add("d-none");
                shortDesc.classList.remove("d-none");
                this.innerText = "Read more";
            }
        });
    });
});
</script>

<style>
    .d-none {
        display: none;
    }
</style>
