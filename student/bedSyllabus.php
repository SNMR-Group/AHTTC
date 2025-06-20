
<section>
    <?php
    require 'academics/eligibility.php';
    ?>
    <div id="bed-section" class="container my-5">
        
        <?php if (!empty($bedData)): ?>  
            <?php foreach ($bedData as $item): ?>
                <div class="syllabus-card mb-4">
                    <h3 class="syllabus-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p>

                        <a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank" class="btn btn-primary">View </a>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p></p>
        <?php endif; ?>
    </div>
    <div class="widget department-download">
 
    <a href="pdf/637288616217533340Prospectus (1).pdf"><i class="far fa-file-pdf"></i>B.Ed Prospectus</a>
    <a href="pdf/637288616217533340syllabus.pdf"><i class="far fa-file-pdf"></i>B.Ed Syllabus</a>
    <a href="pdf"><i class="far fa-file-pdf"></i>B.Ed Fee Structure</a>
    </div>

</section>

<style>
  
    .container {
        max-width: 1200px; 
        margin: 0 auto;
        padding: 0 15px;
    }

   
    h2.text-center {
        font-size: 2rem;
        color: #333;
    }

    .syllabus-card {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s ease;
    }

    .syllabus-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .syllabus-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #444;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px; 
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }


    .my-5 {
        margin-top: 3rem;
        margin-bottom: 3rem;
    }

   
    .syllabus-card p {
        font-size: 1rem;
        color: #666;
    }

    .syllabus-card a {
        text-decoration: none;
        color: #fff;
    }
</style>

