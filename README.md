# 🏨 Hostel Room Booking — Setup & Quick Reference

This README replaces and consolidates previous instructions into a compact, actionable quickstart for local development on Windows (XAMPP). Keep this file at the repo root.

## Quick Start (Windows + XAMPP)

1. Start XAMPP Control Panel → Start Apache and MySQL.
2. Put project folder at: C:\xampp\htdocs\Hostel-Room-Booking
3. Open browser: http://localhost/Hostel-Room-Booking/public/index.php

## Project layout

Hostel-Room-Booking/

- config/ — db_connect.php
- public/ — index.php, rooms.php, book_room.php, (optional admin.php, success.php)
- assets/css/ — style.css
- includes/ — header.php, footer.php
- .env (optional)
- README.md

## Database (create & import)

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create database: hostel_booking (utf8mb4_general_ci)
3. Run these two table queries:

CREATE rooms

```sql
CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_number VARCHAR(10) NOT NULL,
  type VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status ENUM('Available','Booked') DEFAULT 'Available'
);
```

CREATE bookings

```sql
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  check_in DATE NOT NULL,
  check_out DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (room_id) REFERENCES rooms(id)
);
```

Optional sample data:

```sql
INSERT INTO rooms (room_number, type, price, status) VALUES
('101','Single',1500.00,'Available'),
('102','Double',2500.00,'Available'),
('103','Dormitory',800.00,'Available'),
('104','Suite',4000.00,'Available'),
('105','Single',1500.00,'Booked');
```

## config/db_connect.php (example)

Create or update config/db_connect.php to use environment variables or hard-coded credentials for local dev:

```php
<?php
// filepath: config/db_connect.php
$host = getenv('DB_SERVER') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'hostel_booking';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
```

Alternatively create a .env (optional) at repo root:

```
DB_SERVER=localhost
DB_USER=root
DB_PASS=
DB_NAME=hostel_booking
```

## Missing optional files

- public/admin.php — admin dashboard (create if you need management UI)
- public/success.php — booking confirmation page
- .gitignore — recommended to ignore .env, vendor/, .vscode/, \*.log

Recommended .gitignore lines:

```
.env
*.log
.vscode/
.idea/
```

## Common troubleshooting

- "PHP code visible" — ensure accessing via http://localhost/... and Apache is running.
- "Connection failed" — verify XAMPP MySQL running and credentials in db_connect.php or .env.
- CSS not loading — confirm assets path: ../assets/css/style.css from public files; clear cache (Ctrl+F5).

## Next steps (suggested)

- Add admin.php (manage rooms/bookings)
- Implement basic authentication
- Add input validation + prepared statements
- Add success.php and user dashboard
- Consider file uploads for room images

## License & notes

Include your LICENSE file if required. This project is for local development; secure secrets before deploying.
