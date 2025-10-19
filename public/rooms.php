<?php
include "../config/db_connect.php";
include "../includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms - Hostel Booking</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>🏨 Hostel Room Booking System</h1>
            <p class="subtitle">Browse and book your perfect room</p>
        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="rooms.php" class="active">Available Rooms</a>
        </nav>

        <div>
            <h2>🛏️ Available Rooms</h2>
            <p style="color: #666; margin: 10px 0 30px 0;">
                Choose from our selection of comfortable rooms. Click "Book Now" to reserve your room.
            </p>

            <div class="rooms-grid">
                <?php
                // Query to get all rooms with their current status
                $sql = "SELECT * FROM rooms ORDER BY room_number ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = $row['status'];
                        $statusClass = ($status == 'Available') ? 'status-available' : 'status-booked';
                        $isAvailable = ($status == 'Available');

                        echo '<div class="room-card">';
                        echo '    <div class="room-number">Room ' . htmlspecialchars($row['room_number']) . '</div>';
                        echo '    <div class="room-type">📍 ' . htmlspecialchars($row['type']) . '</div>';
                        echo '    <div class="room-price">₹' . number_format($row['price'], 2) . ' <span style="font-size: 0.6em; color: #666;">/ night</span></div>';
                        echo '    <div class="room-status ' . $statusClass . '">' . $status . '</div>';

                        if ($isAvailable) {
                            echo '    <a href="book_room.php?id=' . $row['id'] . '" class="btn" style="width: 100%; text-align: center; margin-top: 10px;">Book Now</a>';
                        } else {
                            echo '    <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;" disabled>Currently Booked</button>';
                        }

                        echo '</div>';
                    }
                } else {
                    echo '<div class="alert alert-info" style="grid-column: 1/-1;">';
                    echo '    <strong>No rooms available!</strong> Please check back later or contact the administration.';
                    echo '</div>';
                }

                $conn->close();
                ?>
            </div>
        </div>

        <?php include "../includes/footer.php"; ?>
    </div>
</body>

</html>