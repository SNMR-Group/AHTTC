<body class="bg-light">
    <!-- Header Section -->
    <header class="bg-success text-white text-center py-4 fade-in">
        <h1 class="fw-bold">Al-Habeeb Teachers' Training College</h1>
        <p class="mb-0">Empowering Educators for a Better Tomorrow</p>
    </header>

    <div class="container mt-5">
        <!-- Vision Section -->
        <section class="mb-4 p-4 border rounded shadow-sm bg-white fade-in">
            <h2 class="text-success"><i class="fas fa-eye me-2"></i>Our Vision</h2>
            <p>To bring out the best in every individual by providing value-based, need-based, and career-oriented education, creating self-reliant citizens and world-class teachers.</p>
        </section>

        <!-- Mission Section -->
        <section class="mb-4 p-4 border rounded shadow-sm bg-white fade-in">
            <h2 class="text-success"><i class="fas fa-bullseye me-2"></i>Our Mission</h2>
            <ul class="list-unstyled">
                <li><i class="fas fa-check-circle text-success me-2"></i> Impart quality education to meet the challenges of a global environment.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Instill ethics and human values.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Develop professional and life skills.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Transform education through moral and ethical foundations.</li>
            </ul>
        </section>

        <!-- Objectives Section -->
        <section class="mb-4 p-4 border rounded shadow-sm bg-white fade-in">
            <h2 class="text-success"><i class="fas fa-tasks me-2"></i>Our Objectives</h2>
            <ul class="list-unstyled">
                <li><i class="fas fa-check-circle text-success me-2"></i> Deliver knowledge and skills through innovative teaching and participatory learning.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Make education an engaging, relevant, and learner-centered activity.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Create socio-cultural, moral, and environmental awareness among students.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Develop human values of concern, compassion, and togetherness.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Instill discipline, honesty, confidence, and self-respect.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Facilitate holistic personality development.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Enable students to adapt and excel in changing times.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Prepare student-teachers to fulfill their roles as nation-builders.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Enhance research skills to find solutions to classroom challenges.</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Preserve high moral and ethical values.</li>
            </ul>
        </section>

        <!-- Core Values Section -->
        <section class="mb-4 p-4 border rounded shadow-sm bg-white fade-in">
            <h2 class="text-success"><i class="fas fa-heart me-2"></i>Our Core Values</h2>
            <ul class="list-inline">
                <li class="list-inline-item badge core-value p-2">Excellence</li>
                <li class="list-inline-item badge core-value p-2">Integrity</li>
                <li class="list-inline-item badge core-value p-2">Trustworthiness</li>
                <li class="list-inline-item badge core-value p-2">Punctuality</li>
                <li class="list-inline-item badge core-value p-2">Purposefulness</li>
            </ul>
        </section>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-success position-fixed bottom-0 end-0 m-3 d-none">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- CSS for Animations -->
    <style>
        /* Fade-in Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hover Animation for Core Values */
        .core-value {
            background-color: #28a745;
            color: white;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .core-value:hover {
            transform: scale(1.1);
            background-color: #218838;
        }

        /* Scroll to Top Button */
        #scrollToTop {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    </style>

    <!-- JavaScript for Animations and Scroll Effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll(".fade-in");
            const scrollToTopBtn = document.getElementById("scrollToTop");

            // Fade-in Effect when Scrolling
            function checkVisibility() {
                sections.forEach(section => {
                    const position = section.getBoundingClientRect().top;
                    if (position < window.innerHeight - 100) {
                        section.classList.add("visible");
                    }
                });
            }

            // Scroll to Top Button Visibility
            window.addEventListener("scroll", function() {
                if (window.scrollY > 300) {
                    scrollToTopBtn.classList.remove("d-none");
                } else {
                    scrollToTopBtn.classList.add("d-none");
                }
                checkVisibility();
            });

            // Scroll to Top Functionality
            scrollToTopBtn.addEventListener("click", function() {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });

            // Initial Check for Visibility
            checkVisibility();
        });
    </script>

    <!-- Bootstrap and FontAwesome Scripts -->
    <!--<script src="https://kit.fontawesome.com/a076d05399.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->
</body>
