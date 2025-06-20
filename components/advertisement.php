
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement</title>
    <style>
        /* Ad container styles */
        .ad-item {
            position: fixed;
            top: 40%; 
            left: -300px; 
            width: 300px; 
            height: 300px; 
            background-color: #1ac748; 
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            animation: slideIn 1s forwards; /* Apply the animation */
        }

        /* Keyframes to animate the ad from left to right */
        @keyframes slideIn {
            0% {
                left: -300px; /* Start off-screen */
            }
            100% {
                left: 10px; /* Position the ad at the top-left corner */
            }
        }

        /* Heading styles */
        .ad-item h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
        }

        /* Text paragraph styles */
        .ad-item p {
            font-size: 16px;
            margin: 15px 0;
            line-height: 1.5;
            font-family: 'Arial', sans-serif;
        }

        /* Link styles */
        .ad-item a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            background-color: #333;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .ad-item a:hover {
            background-color: #FF4500; /* Darker orange on hover */
            text-decoration: underline;
        }

        /* Close button styles */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }
    </style>
</head>
<body>

    <div class="ads-container">
        <?php
        // Include the ads component
        include 'db-ads.php';
        ?>
    </div>

    <script>
        // Function to hide the ad when the close button is clicked
        function closeAd(adId) {
            const adElement = document.getElementById('ad-' + adId);
            if (adElement) {
                adElement.style.display = 'none'; // Hide the ad
            }
        }
    </script>
</body>
</html>
