<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check for JawsDB URL (Heroku)
$jawsdb_url = getenv('JAWSDB_URL');

if ($jawsdb_url) {
    // Running on Heroku - parse the JawsDB URL
    $url = parse_url($jawsdb_url);

    $servername = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $dbname = substr($url["path"], 1); // Remove the leading '/'

} else {
    // Running locally - use .env file
    $env = parse_ini_file(__DIR__ . '/../.env');
    $servername = $env['DB_SERVER'];
    $username = $env['DB_USER'];
    $password = $env['DB_PASS'];
    $dbname = $env['DB_NAME'];
}

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
