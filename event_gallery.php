<?php
// Backend Logic - Database Connection and Data Fetching
require_once "db/db.php"; // Assuming your database connection file

// Function to get all events with their images
function getEventsWithImages($conn) {
    $events = [];
    
    // Get all events
    $events_sql = "SELECT * FROM events ORDER BY event_date DESC";
    $events_result = $conn->query($events_sql);
    
    if ($events_result && $events_result->num_rows > 0) {
        while ($event = $events_result->fetch_assoc()) {
            // Get images for each event
            $images_sql = "SELECT * FROM event_gallery WHERE event_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($images_sql);
            $stmt->bind_param("i", $event['id']);
            $stmt->execute();
            $images_result = $stmt->get_result();
            
            $images = [];
            while ($image = $images_result->fetch_assoc()) {
                $images[] = $image;
            }
            
            $event['images'] = $images;
            $events[] = $event;
        }
    }
    
    return $events;
}

// Function to get featured events (events with images)
function getFeaturedEvents($conn, $limit = 6) {
    $sql = "SELECT e.*, COUNT(eg.id) as image_count 
            FROM events e 
            LEFT JOIN event_gallery eg ON e.id = eg.event_id 
            GROUP BY e.id 
            HAVING image_count > 0 
            ORDER BY e.event_date DESC 
            LIMIT ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $events = [];
    while ($row = $result->fetch_assoc()) {
        // Get first image for preview
        $img_sql = "SELECT image_path FROM event_gallery WHERE event_id = ? ORDER BY created_at ASC LIMIT 1";
        $img_stmt = $conn->prepare($img_sql);
        $img_stmt->bind_param("i", $row['id']);
        $img_stmt->execute();
        $img_result = $img_stmt->get_result();
        $image = $img_result->fetch_assoc();
        
        $row['preview_image'] = $image ? $image['image_path'] : 'images/default-event.jpg';
        $events[] = $row;
    }
    
    return $events;
}

// AJAX Handler for loading event details
if (isset($_GET['ajax']) && $_GET['ajax'] == 'get_event' && isset($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']);
    
    // Get event details
    $event_sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($event_sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
    
    if ($event) {
        // Get event images
        $images_sql = "SELECT * FROM event_gallery WHERE event_id = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($images_sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $images_result = $stmt->get_result();
        
        $images = [];
        while ($image = $images_result->fetch_assoc()) {
            $images[] = $image;
        }
        
        header('Content-Type: application/json');
        echo json_encode([
            'event' => $event,
            'images' => $images
        ]);
        exit;
    }
}

// Fetch data for the page
$featuredEvents = getFeaturedEvents($conn, 6);
$allEvents = getEventsWithImages($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHTTC | Gallery</title>
  <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    :root {
      --primary-green: #2E7D32;       /* Dark green */
      --secondary-green: #388E3C;     /* Medium dark green */
      --accent-green: #4CAF50;        /* Medium green */
      --light-green: #81C784;         /* Light green */
      --lighter-green: #C8E6C9;       /* Very light green */
      --dark-green: #1B5E20;          /* Very dark green */
      --text-dark: #333;
      --text-light: #f8f9fa;
      --gradient-primary: linear-gradient(135deg, var(--dark-green) 0%, var(--primary-green) 100%);
      --gradient-secondary: linear-gradient(135deg, var(--lighter-green) 0%, var(--light-green) 100%);
    }

    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      color: var(--text-dark);
      background-color: #f8f9fa;
    }

    .hero-section {
      background: var(--gradient-primary);
      color: var(--text-light);
      padding: 120px 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.05"><polygon points="0,100 1000,0 1000,100"/></svg>');
      background-size: cover;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .section-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--dark-green);
      position: relative;
      text-align: center;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--accent-green);
      border-radius: 2px;
    }

    .event-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      height: 100%;
      background: white;
    }

    .event-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .event-card-img {
      height: 250px;
      object-fit: cover;
      transition: transform 0.3s ease;
      width: 100%;
    }

    .event-card:hover .event-card-img {
      transform: scale(1.03);
    }

    .event-date {
      position: absolute;
      top: 15px;
      right: 15px;
      background: rgba(255, 255, 255, 0.95);
      padding: 8px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--dark-green);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .event-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--dark-green);
      margin-bottom: 0.75rem;
    }

    .event-description {
      color: #555;
      font-size: 0.95rem;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      margin-bottom: 1rem;
    }

    .btn-view-gallery {
      background: var(--accent-green);
      border: none;
      color: white;
      padding: 10px 25px;
      border-radius: 30px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.85rem;
    }

    .btn-view-gallery:hover {
      background: var(--secondary-green);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      color: white;
    }

    .image-count-badge {
      position: absolute;
      bottom: 15px;
      left: 15px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      backdrop-filter: blur(5px);
    }

    .modal-header {
      background: var(--gradient-primary);
      color: white;
      border: none;
      padding: 1.5rem;
    }

    .modal-title {
      font-weight: 600;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .gallery-item {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      background: white;
    }

    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .gallery-img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-img {
      transform: scale(1.05);
    }

    .gallery-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
      color: white;
      padding: 15px;
      transform: translateY(100%);
      transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
      transform: translateY(0);
    }

    .stats-section {
      background: var(--gradient-secondary);
      padding: 80px 0;
    }

    .stat-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      border: 1px solid rgba(0,0,0,0.05);
    }

    .stat-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: bold;
      color: var(--dark-green);
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 1rem;
      color: #555;
      font-weight: 500;
    }

    .loading-spinner {
      display: none;
      text-align: center;
      padding: 40px;
    }

    .filter-buttons {
      margin-bottom: 40px;
      text-align: center;
    }

    .filter-btn {
      background: transparent;
      border: 2px solid var(--accent-green);
      color: var(--dark-green);
      padding: 8px 20px;
      margin: 5px;
      border-radius: 30px;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 0.9rem;
    }

    .filter-btn:hover,
    .filter-btn.active {
      background: var(--accent-green);
      color: white;
      border-color: var(--accent-green);
    }

    .breadcrumb-title {
      color: white;
      font-weight: 700;
      font-size: 2.5rem;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
    }

    .breadcrumb-menu {
      color: rgba(255,255,255,0.9);
    }

    .breadcrumb-menu a {
      color: white;
      text-decoration: none;
      transition: all 0.2s;
    }

    .breadcrumb-menu a:hover {
      color: var(--lighter-green);
      text-decoration: underline;
    }

    .breadcrumb-menu .active {
      color: var(--lighter-green);
    }

    @media (max-width: 768px) {
      .hero-section {
        padding: 80px 0;
      }
      
      .section-title {
        font-size: 2rem;
      }
      
      .gallery-grid {
        grid-template-columns: 1fr;
      }

      .stat-card {
        padding: 20px;
      }

      .stat-number {
        font-size: 2rem;
      }
    }

    /* Animation classes */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Lightbox styles */
    #imageLightboxModal .modal-content {
      background: transparent;
      border: none;
    }

    #lightboxImage {
      max-height: 70vh;
      max-width: 100%;
      border-radius: 8px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    #lightboxDescription {
      background: rgba(0,0,0,0.7);
      display: inline-block;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 0.9rem;
      margin-top: 10px;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: var(--light-green);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--accent-green);
    }
  </style>
</head>

<body>
  <?php require 'components/nav.php'; ?>

  <!-- Hero Breadcrumb Section -->
  <div class="hero-section">
    <div class="container hero-content">
      <div class="row justify-content-center text-center">
        <div class="col-lg-10">
          <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">Event Gallery</h1>
          <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
            Explore the vibrant moments and memorable events at Al-Habeeb Teacher Training College
          </p>
          <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
            <a href="#featured-events" class="btn btn-light btn-lg px-4">
              <i class="fas fa-images me-2"></i>View Gallery
            </a>
            <a href="#all-events" class="btn btn-outline-light btn-lg px-4">
              <i class="fas fa-calendar me-2"></i>All Events
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4" data-aos="fade-up">
          <div class="stat-card">
            <div class="stat-number"><?php echo count($allEvents); ?></div>
            <div class="stat-label">Total Events</div>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="stat-card">
            <div class="stat-number">
              <?php 
              $totalImages = 0;
              foreach($allEvents as $event) {
                  $totalImages += count($event['images']);
              }
              echo $totalImages;
              ?>
            </div>
            <div class="stat-label">Total Photos</div>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="stat-card">
            <div class="stat-number"><?php echo count($featuredEvents); ?></div>
            <div class="stat-label">Featured Events</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Events Section -->
  <section id="featured-events" class="py-5 bg-white">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title" data-aos="fade-up">Featured Events</h2>
        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
          Highlights from our most memorable occasions
        </p>
      </div>

      <div class="row">
        <?php foreach($featuredEvents as $index => $event): ?>
        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
          <div class="card event-card h-100">
            <div class="position-relative overflow-hidden">
              <img src="<?php echo htmlspecialchars($event['preview_image']); ?>" 
                   class="card-img-top event-card-img" 
                   alt="<?php echo htmlspecialchars($event['event_name']); ?>"
                   onerror="this.src='images/default-event.jpg'">
              <div class="event-date">
                <i class="far fa-calendar-alt me-1"></i>
                <?php echo date('M j, Y', strtotime($event['event_date'])); ?>
              </div>
              <div class="image-count-badge">
                <i class="fas fa-camera me-1"></i>
                <?php echo $event['image_count']; ?> Photos
              </div>
            </div>
            <div class="card-body p-4">
              <h5 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h5>
              <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
              <button class="btn btn-view-gallery w-100 mt-2" 
                      onclick="viewEventGallery(<?php echo $event['id']; ?>)">
                <i class="fas fa-eye me-2"></i>View Gallery
              </button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- All Events Section -->
  <section id="all-events" class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title" data-aos="fade-up">All Events</h2>
        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
          Complete collection of our events and activities
        </p>
      </div>

      <!-- Filter Buttons -->
      <div class="filter-buttons" data-aos="fade-up">
        <button class="filter-btn active" onclick="filterEvents('all')">All Events</button>
        <button class="filter-btn" onclick="filterEvents('recent')">Recent</button>
        <button class="filter-btn" onclick="filterEvents('with-photos')">With Photos</button>
      </div>

      <div class="row" id="events-container">
        <?php foreach($allEvents as $index => $event): ?>
        <div class="col-lg-6 mb-4 event-item" data-aos="fade-up" data-aos-delay="<?php echo ($index % 4) * 100; ?>">
          <div class="card event-card h-100">
            <div class="row g-0 h-100">
              <div class="col-md-5">
                <div class="position-relative h-100">
                  <?php if(!empty($event['images'])): ?>
                    <img src="<?php echo htmlspecialchars($event['images'][0]['image_path']); ?>" 
                         class="img-fluid h-100 w-100" 
                         style="object-fit: cover;"
                         alt="<?php echo htmlspecialchars($event['event_name']); ?>"
                         onerror="this.src='images/default-event.jpg'">
                    <div class="image-count-badge">
                      <i class="fas fa-camera me-1"></i>
                      <?php echo count($event['images']); ?> Photos
                    </div>
                  <?php else: ?>
                    <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                      <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                  <?php endif; ?>
                  <div class="event-date">
                    <i class="far fa-calendar-alt me-1"></i>
                    <?php echo date('M j, Y', strtotime($event['event_date'])); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="card-body h-100 d-flex flex-column">
                  <h5 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h5>
                  <p class="event-description flex-grow-1">
                    <?php echo htmlspecialchars($event['description']); ?>
                  </p>
                  <?php if(!empty($event['images'])): ?>
                    <button class="btn btn-view-gallery mt-auto align-self-start" 
                            onclick="viewEventGallery(<?php echo $event['id']; ?>)">
                      <i class="fas fa-eye me-2"></i>View Gallery
                    </button>
                  <?php else: ?>
                    <span class="text-muted mt-auto">
                      <i class="fas fa-info-circle me-1"></i>No photos available
                    </span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <?php if(empty($allEvents)): ?>
      <div class="text-center py-5" data-aos="fade-up">
        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">No Events Available</h4>
        <p class="text-muted">Check back later for updates on our upcoming events.</p>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Event Gallery Modal -->
  <div class="modal fade" id="eventGalleryModal" tabindex="-1" aria-labelledby="eventGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header">
          <h5 class="modal-title" id="eventGalleryModalLabel">
            <i class="fas fa-images me-2"></i>Event Gallery
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="loading-spinner" id="modalLoading">
            <div class="spinner-border text-success" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading gallery...</p>
          </div>
          
          <div id="eventGalleryContent" style="display: none;">
            <div class="mb-4">
              <h4 id="modalEventTitle" class="text-dark"></h4>
              <p class="text-muted mb-2" id="modalEventDate">
                <i class="far fa-calendar-alt me-1"></i>
                <span id="modalEventDateText"></span>
              </p>
              <p id="modalEventDescription" class="text-muted"></p>
              <hr>
            </div>
            
            <div class="gallery-grid" id="modalGalleryGrid">
              <!-- Images will be loaded here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Image Lightbox Modal -->
  <div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-labelledby="imageLightboxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body p-0 text-center">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                  data-bs-dismiss="modal" aria-label="Close" style="z-index: 1050; background: rgba(0,0,0,0.5); border-radius: 50%; padding: 10px;"></button>
          <img id="lightboxImage" class="img-fluid rounded" style="max-height: 80vh;">
          <div class="mt-3">
            <p id="lightboxDescription" class="text-white mb-0"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require 'components/footer.php'; ?>
  <?php require 'components/scrollup.php'; ?>

  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  
  <script>
      // Initialize AOS (Animate On Scroll)
      AOS.init({
          duration: 800,
          easing: 'ease-in-out',
          once: true
      });

      // View Event Gallery Function
      function viewEventGallery(eventId) {
          const modal = new bootstrap.Modal(document.getElementById('eventGalleryModal'));
          const loading = document.getElementById('modalLoading');
          const content = document.getElementById('eventGalleryContent');
          
          // Show loading
          loading.style.display = 'block';
          content.style.display = 'none';
          modal.show();
          
          // Fetch event data
          fetch(`?ajax=get_event&event_id=${eventId}`)
              .then(response => response.json())
              .then(data => {
                  if (data.event && data.images) {
                      // Populate modal content
                      document.getElementById('modalEventTitle').textContent = data.event.event_name;
                      document.getElementById('modalEventDateText').textContent = 
                          new Date(data.event.event_date).toLocaleDateString('en-US', {
                              year: 'numeric',
                              month: 'long',
                              day: 'numeric'
                          });
                      document.getElementById('modalEventDescription').textContent = data.event.description;
                      
                      // Populate gallery
                      const galleryGrid = document.getElementById('modalGalleryGrid');
                      galleryGrid.innerHTML = '';
                      
                      data.images.forEach(image => {
                          const galleryItem = document.createElement('div');
                          galleryItem.className = 'gallery-item';
                          galleryItem.innerHTML = `
                              <img src="${image.image_path}" 
                                   class="gallery-img" 
                                   alt="${image.description}"
                                   onclick="openLightbox('${image.image_path}', '${image.description}')"
                                   onerror="this.src='images/default-event.jpg'">
                              <div class="gallery-overlay">
                                  <p class="mb-0">${image.description || 'Event Photo'}</p>
                              </div>
                          `;
                          galleryGrid.appendChild(galleryItem);
                      });
                      
                      // Show content
                      loading.style.display = 'none';
                      content.style.display = 'block';
                  }
              })
              .catch(error => {
                  console.error('Error loading gallery:', error);
                  loading.innerHTML = '<p class="text-danger">Error loading gallery. Please try again.</p>';
              });
      }

      // Open Image Lightbox
      function openLightbox(imageSrc, description) {
          document.getElementById('lightboxImage').src = imageSrc;
          document.getElementById('lightboxDescription').textContent = description || 'Event Photo';
          
          const lightboxModal = new bootstrap.Modal(document.getElementById('imageLightboxModal'));
          lightboxModal.show();
      }

      // Filter Events
      function filterEvents(filter) {
          const eventItems = document.querySelectorAll('.event-item');
          const filterBtns = document.querySelectorAll('.filter-btn');
          
          // Update active button
          filterBtns.forEach(btn => btn.classList.remove('active'));
          event.target.classList.add('active');
          
          // Apply filter
          eventItems.forEach(item => {
              const hasPhotos = item.querySelector('.image-count-badge') !== null;
              const eventDate = new Date(item.querySelector('.event-date').textContent.split(' ').slice(1).join(' '));
              const isRecent = (new Date() - eventDate) / (1000 * 60 * 60 * 24) <= 90; // 90 days
              
              let show = true;
              
              switch(filter) {
                  case 'recent':
                      show = isRecent;
                      break;
                  case 'with-photos':
                      show = hasPhotos;
                      break;
                  case 'all':
                  default:
                      show = true;
                      break;
              }
              
              if (show) {
                  item.style.display = 'block';
                  item.classList.add('fade-in', 'visible');
              } else {
                  item.style.display = 'none';
              }
          });
      }

      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
              e.preventDefault();
              const target = document.querySelector(this.getAttribute('href'));
              if (target) {
                  target.scrollIntoView({
                      behavior: 'smooth',
                      block: 'start'
                  });
              }
          });
      });

      // Add fade-in animation to elements as they come into view
      const observerOptions = {
          threshold: 0.1,
          rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.classList.add('visible');
              }
          });
      }, observerOptions);

      document.querySelectorAll('.fade-in').forEach(el => {
          observer.observe(el);
      });

      // Initialize all elements with fade-in class
      document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.fade-in').forEach(el => {
              el.style.opacity = '0';
              el.style.transform = 'translateY(20px)';
          });
      });
  </script>
</body>
</html>