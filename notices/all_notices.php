<?php
// Include database connection
try {
    require 'db/db.php';
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch active notices
$notices = [];
$error_message = '';

try {
    $sql = "SELECT id, title, link, created_at FROM all_notices WHERE status = 'active' ORDER BY created_at DESC"; 
    $result = $conn->query($sql);
    
    if ($result) {
        $notices = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error_message = "Error fetching notices: " . $conn->error;
    }
} catch (Exception $e) {
    $error_message = "Database error: " . $e->getMessage();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .notices-section {
            padding: 40px 0;
            background: #ffffff;
        }
        
        .notices-container {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 8px 16px rgba(0, 0, 0, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            height: 450px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .notices-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #28a745, #20c997, #17a2b8, #6f42c1);
            background-size: 300% 100%;
            animation: gradient-shift 3s ease-in-out infinite;
        }
        
        .notices-container:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 12px 24px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .notices-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid transparent;
            background: linear-gradient(90deg, transparent 0%, rgba(40, 167, 69, 0.1) 50%, transparent 100%);
            border-radius: 10px;
            position: relative;
        }
        
        .notices-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #28a745, #20c997);
            border-radius: 2px;
        }
        
        .notices-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            letter-spacing: -0.5px;
        }
        
        .title-icon {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            margin-right: 15px;
            font-size: 1.6rem;
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            animation: icon-pulse 2s ease-in-out infinite;
        }
        
        .marquee-container {
            height: 320px;
            overflow: hidden;
            position: relative;
            border-radius: 15px;
            border: 1px solid rgba(40, 167, 69, 0.1);
            background: linear-gradient(135deg, #fafbfc 0%, #f8f9fa 100%);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.02),
                0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .marquee-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to bottom, rgba(248, 249, 250, 0.9), transparent);
            z-index: 2;
            pointer-events: none;
        }
        
        .marquee-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to top, rgba(248, 249, 250, 0.9), transparent);
            z-index: 2;
            pointer-events: none;
        }
        
        .marquee-content {
            animation: scroll-up 20s linear infinite;
            padding: 15px;
        }
        
        .notice-item {
            background: linear-gradient(145deg, #ffffff 0%, #fdfdfd 100%);
            margin-bottom: 15px;
            padding: 22px 24px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 
                0 4px 12px rgba(0, 0, 0, 0.05),
                0 2px 4px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .notice-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 0 3px 3px 0;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .notice-item::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(40, 167, 69, 0.05), transparent);
            transform: rotate(45deg) translate(-100%, -100%);
            transition: transform 0.6s ease;
        }
        
        .notice-item:hover {
            border-color: rgba(40, 167, 69, 0.2);
            box-shadow: 
                0 8px 25px rgba(40, 167, 69, 0.12),
                0 4px 12px rgba(0, 0, 0, 0.06);
            transform: translateY(-3px) scale(1.01);
        }
        
        .notice-item:hover::before {
            transform: scaleY(1);
        }
        
        .notice-item:hover::after {
            transform: rotate(45deg) translate(0, 0);
        }
        
        .notice-title {
            font-size: 1.05rem;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
            text-decoration: none;
            display: block;
            line-height: 1.4;
        }
        
        .notice-title:hover {
            color: #28a745;
            text-decoration: none;
        }
        
        .notice-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .notice-date {
            display: flex;
            align-items: center;
        }
        
        .date-icon {
            margin-right: 6px;
            font-size: 0.9rem;
        }
        
        .new-badge {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 2s infinite;
        }
        
        .external-link-icon {
            color: #6c757d;
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .notice-item:hover .external-link-icon {
            opacity: 1;
        }
        
        .no-notices {
            text-align: center;
            color: #6c757d;
            padding: 60px 30px;
        }
        
        .no-notices-icon {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 15px;
            display: block;
        }
        
        .error-notice {
            background: #fff5f5;
            color: #e53e3e;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #fed7d7;
        }
        
        .pdf-icon {
            margin-right: 8px;
            color: #e53e3e;
        }
        
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes icon-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes scroll-up {
            0% {
                transform: translateY(100%);
            }
            100% {
                transform: translateY(-100%);
            }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .marquee-container:hover .marquee-content {
            animation-play-state: paused;
        }
        
        /* Scrollbar styling for webkit browsers */
        .marquee-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .marquee-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .marquee-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        
        .marquee-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .notices-section {
                padding: 20px 0;
            }
            
            .notices-container {
                margin: 0 15px;
                padding: 25px;
                height: 400px;
            }
            
            .marquee-container {
                height: 270px;
            }
            
            .notice-item {
                padding: 15px;
            }
            
            .notice-title {
                font-size: 1rem;
            }
            
            .notices-title {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 576px) {
            .notices-container {
                margin: 0 10px;
                padding: 15px;
            }
            
            .notice-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
        
        /* Focus states for accessibility */
        .notice-item:focus {
            outline: 2px solid #28a745;
            outline-offset: 2px;
        }
        
        /* Loading state */
        .loading-notice {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #28a745;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<section class="notices-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="notices-container">
                    <div class="notices-header">
                        <h3 class="notices-title">
                            <i class="bi bi-bell title-icon"></i>
                            Latest Notices
                        </h3>
                    </div>
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="error-notice">
                            <i class="bi bi-exclamation-triangle-fill" style="margin-right: 8px;"></i>
                            Unable to load notices at this time. Please try again later.
                        </div>
                    <?php elseif (empty($notices)): ?>
                        <div class="no-notices">
                            <i class="bi bi-inbox no-notices-icon"></i>
                            <h5>No Notices Available</h5>
                            <p class="mb-0">Check back later for new announcements.</p>
                        </div>
                    <?php else: ?>
                        <div class="marquee-container">
                            <div class="marquee-content">
                                <?php 
                                // Display each notice only once - no duplication
                                foreach ($notices as $notice): 
                                    $isNew = (time() - strtotime($notice['created_at'])) < (7 * 24 * 60 * 60);
                                ?>
                                    <div class="notice-item" 
                                         onclick="window.open('<?php echo htmlspecialchars($notice['link']); ?>', '_blank')"
                                         tabindex="0"
                                         role="button"
                                         aria-label="Open notice: <?php echo htmlspecialchars($notice['title']); ?>">
                                        <a href="<?php echo htmlspecialchars($notice['link']); ?>" 
                                           target="_blank" 
                                           class="notice-title"
                                           onclick="event.stopPropagation();">
                                            <i class="bi bi-file-earmark-pdf pdf-icon"></i>
                                            <?php echo htmlspecialchars($notice['title']); ?>
                                        </a>
                                        <div class="notice-meta">
                                            <div class="notice-date">
                                                <i class="bi bi-calendar3 date-icon"></i>
                                                <?php echo date('d M Y', strtotime($notice['created_at'])); ?>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <?php if ($isNew): ?>
                                                    <span class="new-badge">New</span>
                                                <?php endif; ?>
                                                <i class="bi bi-box-arrow-up-right external-link-icon ms-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const marqueeContent = document.querySelector('.marquee-content');
    
    if (marqueeContent) {
        // Adjust animation duration based on content length
        const noticeCount = document.querySelectorAll('.notice-item').length;
        const duration = Math.max(15, noticeCount * 2.5);
        marqueeContent.style.animationDuration = duration + 's';
        
        // Add keyboard navigation
        document.querySelectorAll('.notice-item').forEach(item => {
            item.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const link = this.querySelector('.notice-title');
                    if (link) {
                        window.open(link.getAttribute('href'), '_blank');
                    }
                }
            });
            
            // Add click effect
            item.addEventListener('click', function(e) {
                this.style.transform = 'translateY(-2px) scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    }
    
    // Add smooth hover effects
    const noticeItems = document.querySelectorAll('.notice-item');
    noticeItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
});

// Intersection Observer for performance optimization
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const marqueeContent = entry.target.querySelector('.marquee-content');
                if (marqueeContent) {
                    marqueeContent.style.animationPlayState = 'running';
                }
            } else {
                const marqueeContent = entry.target.querySelector('.marquee-content');
                if (marqueeContent) {
                    marqueeContent.style.animationPlayState = 'paused';
                }
            }
        });
    });
    
    const noticesContainer = document.querySelector('.notices-container');
    if (noticesContainer) {
        observer.observe(noticesContainer);
    }
}
</script>

</body>
</html>