<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-ABn0K18ZJJHptuEucAt5PeUj8XZBm+NEkd1/t5ZWDb0xrAk5w8hZ7kCDA0uNjDEc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="counter-area pt-60 pb-60 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="images/icons/counter-courses.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="2" data-speed="3000">0</span>
                            <h6 class="title">+ Total Courses</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="images/icons/students.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="2000" data-speed="3000">0</span>
                            <h6 class="title">+ Our Students</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="images/icons/teacher-2.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="24" data-speed="3000">0</span>
                            <h6 class="title">+ Skilled Lecturers</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="images/icons/awards.svg" alt="Al-Habeeb Teacher Training College">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="10" data-speed="3000">0</span>
                            <h6 class="title">+ Win Awards</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        function animateCounter(counter) {
            const target = +counter.getAttribute('data-to');
            const speed = +counter.getAttribute('data-speed');
            const increment = target / (speed / 50);
            let count = 0;

            const updateCounter = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = Math.floor(count);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        }

        function startCounters(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => animateCounter(counter));
                    observer.unobserve(entry.target); 
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const counterSection = document.querySelector('.counter-area');
            if (counterSection) {
                const observer = new IntersectionObserver(startCounters, {
                    threshold: 0.5
                });
                observer.observe(counterSection);
            }
        });
    </script>

</body>

</html>