

    <!-- Bootstrap, Font Awesome & Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Library Section */
        .library-section {
            background: linear-gradient(135deg, #2E7D32, #66BB6A);
            color: white;
            padding: 60px 0;
            text-align: center;
            box-shadow: 0px 5px 20px rgba(0, 139, 0, 0.3);
        }

        .library-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 0 0 15px rgba(0, 255, 0, 0.6);
            margin-bottom: 20px;
        }

        /* Stats Cards */
        .library-stat {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 255, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .library-stat:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 255, 0, 0.5);
        }

        .library-stat i {
            font-size: 3rem;
            color: #FFD700;
            margin-bottom: 10px;
        }

        /* Regulations Section */
        .accordion-button {
            font-weight: bold;
            background: #388E3C;
            color: white;
        }

        .accordion-button:not(.collapsed) {
            background: #43A047;
        }

        /* E-Book Section */
        .ebook-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            cursor: pointer;
        }

        .ebook-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 255, 0, 0.4);
        }

        .ebook-card img {
            width: 100%;
            border-radius: 10px;
        }

        .ebook-btn {
            background:rgb(41, 138, 85);
            color: black;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px 20px;
            text-decoration: none;
        }

        .ebook-btn:hover {
            background:rgb(24, 150, 97);
            color: white;
        }
    </style>
    <!-- Library Section -->
    <section class="library-section">
        <div class="container">
            <h2 class="animate__animated animate__fadeInDown">📚 College Library</h2>
            <p class="animate__animated animate__fadeInUp">Explore a vast collection of books, journals, and e-books.</p>

            <div class="row mt-4 g-4">
                <!-- Stats Cards -->
                <div class="col-md-4">
                    <div class="library-stat animate__animated animate__fadeInLeft">
                        <i class="fas fa-book"></i>
                        <h5>Text Books</h5>
                        <p>11,246</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="library-stat animate__animated animate__fadeInUp">
                        <i class="fas fa-book-open"></i>
                        <h5>Reference Books</h5>
                        <p>720</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="library-stat animate__animated animate__fadeInRight">
                        <i class="fas fa-globe"></i>
                        <h5>National Journals</h5>
                        <p>86</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-md-4">
                    <div class="library-stat animate__animated animate__fadeInLeft">
                        <i class="fas fa-globe-americas"></i>
                        <h5>International Journals</h5>
                        <p>99</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="library-stat animate__animated animate__fadeInUp">
                        <i class="fas fa-book-reader"></i>
                        <h5>Encyclopedia</h5>
                        <p>192</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Library Regulations -->
    <section class="container mt-5">
        <h3 class="text-center mb-4">📖 Library Regulations</h3>
        <div class="accordion" id="libraryRegulations">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#reg1">
                        🕘 Library Timings & Attendance
                    </button>
                </h2>
                <div id="reg1" class="accordion-collapse collapse show" data-bs-parent="#libraryRegulations">
                    <div class="accordion-body">
                        Classes begin at 9:40 AM. Attendance is taken at the beginning of each period. Students must be in class when attendance is taken.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reg2">
                        🆔 Identity Card Requirement
                    </button>
                </h2>
                <div id="reg2" class="accordion-collapse collapse" data-bs-parent="#libraryRegulations">
                    <div class="accordion-body">
                        Every student must carry an identity card issued by the college, signed by the principal.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E-Book Section -->
    <section class="container mt-5">
        <h3 class="text-center mb-4">📲 E-Book Collection</h3>
        <div class="row g-4">
            <div class="col-md-4 mb-5">
                <div class="ebook-card text-center">
                    <img src="https://via.placeholder.com/200" alt="Al-Habeeb Teacher Training College">
                    <h5 class="mt-3">Digital Library Access</h5>
                    <a href="login_system/login.php" class="ebook-btn mt-2">Read Now</a>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="ebook-card text-center">
                    <img src="https://via.placeholder.com/200" alt="Al-Habeeb Teacher Training College">
                    <h5 class="mt-3">Modern Teaching Methods</h5>
                    <a href="#" class="ebook-btn mt-2">Read Now</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

