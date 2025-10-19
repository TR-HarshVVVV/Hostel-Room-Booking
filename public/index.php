<?php include "../includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Room Booking - Home</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>🏨 Hostel Room Booking System</h1>
            <p class="subtitle">Your comfort is our priority - Book your perfect room today!</p>
        </header>

        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="rooms.php">Available Rooms</a>
        </nav>

        <div style="text-align: center; padding: 40px 20px;">
            <div style="max-width: 600px; margin: 0 auto;">
                <h2>Welcome to Our Hostel</h2>
                <p style="color: #666; font-size: 1.1em; line-height: 1.8; margin: 20px 0;">
                    Experience comfortable and affordable accommodation in our modern hostel.
                    We offer a variety of room types to suit your needs, from budget-friendly
                    dormitories to private suites.
                </p>

                <div class="flex-center" style="margin-top: 40px;">
                    <a href="rooms.php" class="btn">View Available Rooms</a>
                    <a href="#features" class="btn btn-secondary">Learn More</a>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" style="margin-top: 60px;">
                <h2 style="margin-bottom: 30px;">Why Choose Us?</h2>
                <div class="rooms-grid" style="max-width: 900px; margin: 0 auto;">
                    <div class="room-card" style="text-align: center;">
                        <div style="font-size: 3em; margin-bottom: 15px;">💰</div>
                        <h3 style="color: #667eea; margin-bottom: 10px;">Affordable Rates</h3>
                        <p style="color: #666;">Competitive pricing without compromising on quality and comfort.</p>
                    </div>

                    <div class="room-card" style="text-align: center;">
                        <div style="font-size: 3em; margin-bottom: 15px;">⚡</div>
                        <h3 style="color: #667eea; margin-bottom: 10px;">Quick Booking</h3>
                        <p style="color: #666;">Simple and fast reservation process - book your room in minutes.</p>
                    </div>

                    <div class="room-card" style="text-align: center;">
                        <div style="font-size: 3em; margin-bottom: 15px;">🛏️</div>
                        <h3 style="color: #667eea; margin-bottom: 10px;">Clean & Comfortable</h3>
                        <p style="color: #666;">Well-maintained rooms with all essential amenities included.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include "../includes/footer.php"; ?>
    </div>
</body>

</html>