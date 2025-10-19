<?php
// Start session if needed for future authentication
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include_once __DIR__ . "/../config/db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hostel Room Booking System - Book comfortable rooms at affordable prices">
    <meta name="keywords" content="hostel, booking, accommodation, rooms">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>