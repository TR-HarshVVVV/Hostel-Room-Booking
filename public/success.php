<?php include "../includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful - Hostel Booking</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .success-icon {
            font-size: 5em;
            color: #28a745;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 3;
            stroke: #28a745;
            stroke-miterlimit: 10;
            margin: 20px auto;
            box-shadow: inset 0px 0px 0px #28a745;
            animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 3;
            stroke-miterlimit: 10;
            stroke: #28a745;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 50px #28a745;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>🏨 Hostel Room Booking System</h1>
        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="rooms.php">Available Rooms</a>
            <a href="admin.php">Admin Dashboard</a>
        </nav>

        <div style="text-align: center; padding: 40px 20px;">
            <?php if (isset($_GET['booking']) && $_GET['booking'] == 'success'): ?>

                <!-- Success Animation -->
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>

                <div class="alert alert-success" style="max-width: 600px; margin: 20px auto; font-size: 1.1em;">
                    <strong>🎉 Booking Confirmed!</strong>
                    <p style="margin-top: 10px;">Your room has been successfully reserved.</p>
                </div>

                <div style="max-width: 500px; margin: 30px auto; text-align: left; background: #f8f9fa; padding: 25px; border-radius: 12px;">
                    <h3 style="color: #667eea; margin-bottom: 15px;">📧 Next Steps:</h3>
                    <ul style="line-height: 2; color: #555;">
                        <li>A confirmation email has been sent to your email address</li>
                        <li>Please check your inbox for booking details</li>
                        <li>Bring a valid ID on your check-in date</li>
                        <li>Arrive between 2:00 PM - 10:00 PM on check-in day</li>
                    </ul>
                </div>

                <div class="flex-center" style="margin-top: 40px;">
                    <a href="rooms.php" class="btn">Book Another Room</a>
                    <a href="index.php" class="btn btn-secondary">Return Home</a>
                </div>

            <?php else: ?>

                <div class="alert alert-error" style="max-width: 600px; margin: 30px auto;">
                    <strong>⚠️ Invalid Access!</strong>
                    <p style="margin-top: 10px;">This page can only be accessed after a successful booking.</p>
                </div>

                <div style="margin-top: 30px;">
                    <a href="rooms.php" class="btn">View Available Rooms</a>
                </div>

            <?php endif; ?>
        </div>

        <?php include "../includes/footer.php"; ?>
    </div>
</body>

</html>