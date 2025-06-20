<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Carousel - Unique Design</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        body {
            background-color: #0d0d0d;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .partner-area {
            padding: 60px 0;
            position: relative;
        }

        .partner-heading {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #0dcaf0;
        }

        .partner-slider .item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(13, 202, 240, 0.4);
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .partner-slider .item::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: rgba(255, 255, 255, 0.1);
            transition: 0.5s;
        }

        .partner-slider .item:hover::before {
            left: 0;
        }

        .partner-slider .item img {
            width: 100px;
            height: auto;
            display: block;
            margin: auto;
            filter: brightness(0.9);
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        }

        .partner-slider .item:hover img {
            transform: scale(1.1);
            filter: brightness(1);
        }

        /* Custom Navigation */
        .owl-nav button {
            background: none !important;
            border: none !important;
            font-size: 32px !important;
            color: #0dcaf0 !important;
            transition: 0.3s ease-in-out;
        }

        .owl-nav button:hover {
            color: #fff !important;
            transform: scale(1.2);
        }

        .custom-prev {
            position: absolute;
            top: 50%;
            left: -40px;
            transform: translateY(-50%);
        }

        .custom-next {
            position: absolute;
            top: 50%;
            right: -40px;
            transform: translateY(-50%);
        }

    </style>
</head>
<body>
    <div class="container">
      
        <div class="partner-area">
            <div class="owl-carousel partner-slider">
                <div class="item"><img src="images/partner/1.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/2.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/3.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/4.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/5.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/6.png" alt="Al-Habeeb Teacher Training College"></div>
                <div class="item"><img src="images/partner/7.png" alt="Al-Habeeb Teacher Training College"></div>
            </div>
            <!-- Custom Navigation -->
            <button class="custom-prev"><i class="bi bi-chevron-left"></i></button>
            <button class="custom-next"><i class="bi bi-chevron-right"></i></button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function(){
            var owl = $(".partner-slider");
            owl.owlCarousel({
                items: 4,
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplaySpeed: 800,
                slideBy: 1,
                autoplayHoverPause: true,
                dots: false,
                nav: false,
                responsive: {
                    0: { items: 2 },
                    600: { items: 3 },
                    1000: { items: 4 }
                }
            });

            // Custom navigation
            $(".custom-prev").click(function() {
                owl.trigger("prev.owl.carousel");
            });

            $(".custom-next").click(function() {
                owl.trigger("next.owl.carousel");
            });
        });
    </script>
</body>
</html>
