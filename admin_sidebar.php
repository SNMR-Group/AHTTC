<!-- Beautiful Sidebar Component -->
<div class="sidebar" id="sidebar">
    <!-- Brand Section -->
    <div class="brand-section">
        <div class="brand-logo">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="brand-title">Al-Habeeb</div>
        <div class="brand-subtitle">Teacher Training College</div>
    </div>

    <!-- Navigation Menu -->
    <div class="nav-menu">
        <div class="nav-item">
            <a href="admin.php" class="nav-link active">
                <div class="nav-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_gallery.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-images"></i>
                </div>
                <span class="nav-text">Gallery</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_event_gallery.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <span class="nav-text">Event Gallery</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_notices.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <span class="nav-text">Notice</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_all_notices.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span class="nav-text">All Notices</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_teaching.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="nav-text">Teaching Staffs</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_non_teaching.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span class="nav-text">Non Teaching Staffs</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_ebook.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <span class="nav-text">E-book</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_syllabus.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-file-contract"></i>
                </div>
                <span class="nav-text">Syllabus</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_naac.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <span class="nav-text">NAAC</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="admin_download.php" class="nav-link">
                <div class="nav-icon">
                    <i class="fas fa-cloud-download-alt"></i>
                </div>
                <span class="nav-text">Download Documents</span>
            </a>
        </div>
    </div>

    <!-- Logout Section -->
    <div class="logout-section">
        <a href="admin.php?logout=true" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

<!-- Mobile Toggle Button (Place this in your header) -->
<button class="mobile-toggle" onclick="toggleSidebar()" style="display: none;">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" onclick="closeSidebar()"></div>

<style>
/* Sidebar Styles */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 280px;
    height: 100vh;
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    backdrop-filter: blur(20px);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    flex-direction: column;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    overflow-y: auto;
}

/* Custom Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Brand Section */
.brand-section {
    padding: 2rem 1.5rem;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
}

.brand-logo {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.3s ease;
}

.brand-logo:hover {
    transform: scale(1.05);
}

.brand-logo i {
    font-size: 1.5rem;
    color: white;
}

.brand-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-family: 'Poppins', sans-serif;
}

.brand-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    font-weight: 300;
    font-family: 'Poppins', sans-serif;
}

/* Navigation Menu */
.nav-menu {
    flex: 1;
    padding: 1rem 0;
    overflow-y: auto;
}

.nav-item {
    margin: 0.5rem 1rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link:hover,
.nav-link.active {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    transform: translateX(8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.nav-icon {
    width: 24px;
    height: 24px;
    margin-right: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.nav-text {
    font-weight: 500;
    font-size: 0.95rem;
}

/* Active state indicator */
.nav-link.active::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: white;
    border-radius: 2px 0 0 2px;
}

/* Logout Section */
.logout-section {
    padding: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.logout-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background: rgba(239, 68, 68, 0.2);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    border: 1px solid rgba(239, 68, 68, 0.3);
    transition: all 0.3s ease;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
}

.logout-btn:hover {
    background: rgba(239, 68, 68, 0.8);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
}

.logout-btn i {
    margin-right: 0.75rem;
    font-size: 1rem;
}

/* Mobile Toggle Button */
.mobile-toggle {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.75rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.mobile-toggle:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

/* Sidebar Overlay */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(2px);
}

.sidebar-overlay.active {
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .sidebar {
        width: 260px;
    }
}

@media (max-width: 768px) {
    .mobile-toggle {
        display: block !important;
    }

    .sidebar {
        transform: translateX(-100%);
        width: 280px;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar-overlay {
        display: block;
    }

    .nav-link {
        padding: 1.25rem;
    }

    .nav-text {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 100%;
    }

    .brand-section {
        padding: 1.5rem;
    }

    .brand-title {
        font-size: 1.1rem;
    }

    .nav-link {
        margin: 0.25rem 0.75rem;
        padding: 1rem;
    }
}

/* Animation Classes */
.slide-in {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateX(-100%);
    }
    to {
        transform: translateX(0);
    }
}

.fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

<script>
// Sidebar functionality
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
    
    if (sidebar.classList.contains('active')) {
        sidebar.classList.add('slide-in');
        overlay.classList.add('fade-in');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
}

// Handle navigation active states
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPage = window.location.pathname.split('/').pop();
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        
        if (href === currentPage || (currentPage === '' && href === 'admin.php')) {
            link.classList.add('active');
        }
    });
});

// Close sidebar when clicking on nav link on mobile
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            closeSidebar();
        }
    });
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }
});
</script>