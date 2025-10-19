<?php
include_once "../config/db_connect.php";
include "../includes/header.php";

$message = "";
$messageType = "";

// Handle form submission
if (isset($_POST['submit'])) {
    $room_id = $conn->real_escape_string($_POST['room_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $check_in = $conn->real_escape_string($_POST['check_in']);
    $check_out = $conn->real_escape_string($_POST['check_out']);

    // Validation
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if dates are valid
        $today = date('Y-m-d');
        if ($check_in < $today) {
            $message = "Check-in date cannot be in the past!";
            $messageType = "error";
        } elseif ($check_out <= $check_in) {
            $message = "Check-out date must be after check-in date!";
            $messageType = "error";
        } else {
            // Check if room is still available
            $check_room = $conn->query("SELECT status FROM rooms WHERE id='$room_id'");
            $room = $check_room->fetch_assoc();

            if ($room['status'] == 'Available') {
                // Insert booking
                $sql = "INSERT INTO bookings (room_id, name, email, check_in, check_out) 
                        VALUES ('$room_id', '$name', '$email', '$check_in', '$check_out')";

                if ($conn->query($sql)) {
                    // Update room status
                    $conn->query("UPDATE rooms SET status='Booked' WHERE id='$room_id'");
                    header("Location: success.php?booking=success");
                    exit();
                } else {
                    $message = "Error processing booking. Please try again.";
                    $messageType = "error";
                }
            } else {
                $message = "Sorry, this room has already been booked!";
                $messageType = "error";
            }
        }
    } else {
        $message = "Please fill in all fields with valid information!";
        $messageType = "error";
    }
}

// Get room details if ID is provided
$room_details = null;
if (isset($_GET['id'])) {
    $room_id = $conn->real_escape_string($_GET['id']);
    $result = $conn->query("SELECT * FROM rooms WHERE id='$room_id'");
    $room_details = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room - Hostel Booking</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>🏨 Hostel Room Booking System</h1>
            <p class="subtitle">Complete your reservation</p>
        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="rooms.php">Available Rooms</a>
        </nav>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($room_details): ?>
            <?php if ($room_details['status'] == 'Available'): ?>

                <!-- Room Summary -->
                <div class="room-card" style="max-width: 600px; margin: 20px auto;">
                    <h3 style="color: #667eea; margin-bottom: 15px;">Room Details</h3>
                    <div class="room-number" style="font-size: 1.5em;">Room <?php echo htmlspecialchars($room_details['room_number']); ?></div>
                    <div class="room-type">Type: <?php echo htmlspecialchars($room_details['type']); ?></div>
                    <div class="room-price">₹<?php echo number_format($room_details['price'], 2); ?> per night</div>
                </div>

                <!-- Booking Form -->
                <div class="form-container" style="max-width: 600px; margin: 30px auto;">
                    <h2 style="color: #667eea; margin-bottom: 20px;">📝 Booking Information</h2>

                    <form method="POST" action="">
                        <input type="hidden" name="room_id" value="<?php echo $room_details['id']; ?>">

                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="check_in">Check-In Date *</label>
                            <input type="date" id="check_in" name="check_in" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="check_out">Check-Out Date *</label>
                            <input type="date" id="check_out" name="check_out" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                        </div>

                        <div class="flex-center" style="margin-top: 30px;">
                            <button type="submit" name="submit" class="btn">Confirm Booking</button>
                            <a href="rooms.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <div class="alert alert-error" style="max-width: 600px; margin: 30px auto;">
                    <strong>Room Not Available!</strong> This room has already been booked. Please <a href="rooms.php" style="color: #721c24; text-decoration: underline;">choose another room</a>.
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-error" style="max-width: 600px; margin: 30px auto;">
                <strong>Invalid Room!</strong> No room found with this ID. Please <a href="rooms.php" style="color: #721c24; text-decoration: underline;">return to room listing</a>.
            </div>
        <?php endif; ?>

        <?php include "../includes/footer.php"; ?>
    </div>

    <script>
        // Simple date validation
        document.getElementById('check_in')?.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const checkOutInput = document.getElementById('check_out');
            const minCheckOut = new Date(checkInDate);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            checkOutInput.min = minCheckOut.toISOString().split('T')[0];
        });
    </script>
</body>

</html>

<?php $conn->close(); ?>