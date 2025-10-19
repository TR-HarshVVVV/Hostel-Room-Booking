# 🏨 Hostel Room Booking System - Setup Guide

## 📋 Table of Contents

1. [Project Structure](#project-structure)
2. [Installation Steps](#installation-steps)
3. [Database Setup](#database-setup)
4. [File Organization](#file-organization)
5. [Testing the Application](#testing-the-application)
6. [Common Issues & Solutions](#common-issues--solutions)
7. [Missing Files Setup](#missing-files-setup)

---

## 📁 Project Structure

```
Hostel-Room-Booking/
│
├── config/
│   └── db_connect.php          # Database connection file
│
├── public/
│   ├── index.php               # Homepage
│   ├── rooms.php               # Display available rooms
│   └── book_room.php           # Booking form
│
├── assets/
│   └── css/
│       └── style.css           # Main stylesheet
│
├── includes/
│   ├── header.php              # Common header
│   └── footer.php              # Common footer
│
├── LICENSE                     # Project license
└── README.md                   # Project documentation
```

**Note:** Some files mentioned in the original setup (admin.php, success.php, .env, .gitignore) are not present in the current project structure. See the [Missing Files Setup](#missing-files-setup) section for details.

---

## 🚀 Installation Steps

### Step 1: Set Up Your Environment

**Prerequisites:**

- XAMPP, WAMP, or MAMP installed
- Basic understanding of HTML, CSS, and C++ (PHP syntax is similar!)
- Web browser (Chrome, Firefox, etc.)

### Step 2: Create Project Folder

1. Navigate to your web server's root directory:

   - **XAMPP**: `C:\xampp\htdocs\`
   - **WAMP**: `C:\wamp64\www\`
   - **MAMP**: `/Applications/MAMP/htdocs/`

2. Create a new folder called `Hostel-Room-Booking`

### Step 3: Create Folder Structure

Inside `Hostel-Room-Booking`, create these folders:

```
Hostel-Room-Booking/
├── config/
├── public/
├── assets/
│   └── css/
└── includes/
```

### Step 4: Create the CSS File

1. Inside `assets/css/`, create a file called `style.css`
2. Copy the CSS code from the "Modern Hostel Booking Stylesheet" artifact

### Step 5: Create PHP Files

Create these files in their respective folders and copy the code from the artifacts:

**In `config/` folder:**

- `db_connect.php`

**In `public/` folder:**

- `index.php`
- `rooms.php`
- `book_room.php`

**Note:** `admin.php` and `success.php` are not included in the current project. See the [Missing Files Setup](#missing-files-setup) section for creating these files.

**In `includes/` folder:**

- `header.php`
- `footer.php`

### Step 6: Create Environment File (Optional)

1. In the root `Hostel-Room-Booking` folder, create a file named `.env`
2. Add this content (update with your database credentials):

```ini
DB_SERVER=localhost
DB_USER=root
DB_PASS=
DB_NAME=hostel_booking
```

**Note:** For XAMPP, the default password is empty. For MAMP, it's usually `root`. The current project uses direct database configuration in `config/db_connect.php`.

---

## 🗄️ Database Setup

### Step 1: Start Your Server

1. Open XAMPP/WAMP/MAMP Control Panel
2. Start **Apache** and **MySQL** services

### Step 2: Create Database

1. Open your web browser
2. Go to: `http://localhost/phpmyadmin`
3. Click on "New" in the left sidebar
4. Database name: `hostel_booking`
5. Collation: `utf8mb4_general_ci`
6. Click "Create"

### Step 3: Create Tables

Click on your `hostel_booking` database, then click "SQL" tab. Run these queries:

**Create Rooms Table:**

```sql
CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_number VARCHAR(10) NOT NULL,
  type VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status ENUM('Available','Booked') DEFAULT 'Available'
);
```

**Create Bookings Table:**

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

### Step 4: Add Sample Data

Insert some sample rooms:

```sql
INSERT INTO rooms (room_number, type, price, status) VALUES
('101', 'Single', 1500.00, 'Available'),
('102', 'Double', 2500.00, 'Available'),
('103', 'Dormitory', 800.00, 'Available'),
('104', 'Suite', 4000.00, 'Available'),
('105', 'Single', 1500.00, 'Booked');
```

---

## 📂 File Organization

### Understanding the Files:

**1. config/db_connect.php**

- Connects to your MySQL database
- Uses credentials from `.env` file
- Think of it like `#include` in C++ but for database connection

**2. public/index.php**

- The homepage/landing page
- Shows welcome message and navigation
- Entry point for users

**3. public/rooms.php**

- Displays all available rooms
- Shows room details (number, type, price, status)
- Like a `for` loop displaying data from database

**4. public/book_room.php**

- Booking form page
- Validates user input (similar to input validation in C++)
- Inserts booking into database

**5. public/admin.php** _(Not included in current project)_

- Admin control panel
- View all rooms and bookings
- Add new rooms
- Update room status

**6. public/success.php** _(Not included in current project)_

- Confirmation page after successful booking
- Shows success animation

**7. assets/css/style.css**

- All styling and design
- Makes the website look beautiful
- Like formatting output in C++, but for web pages

**8. includes/header.php & footer.php**

- Reusable components (like functions in C++)
- Header included at top of every page
- Footer included at bottom

---

## 🧪 Testing the Application

### Step 1: Access the Homepage

1. Open browser
2. Go to: `http://localhost/Hostel-Room-Booking/public/index.php`
3. You should see the welcome page

### Step 2: View Available Rooms

1. Click "View Available Rooms"
2. You should see all rooms from database
3. Check that prices and status display correctly

### Step 3: Test Booking

1. Click "Book Now" on an available room
2. Fill in the form:
   - Name: Your Name
   - Email: test@example.com
   - Check-in: Today's date or future
   - Check-out: Date after check-in
3. Click "Confirm Booking"
4. Should redirect to success page

### Step 4: Check Admin Dashboard

**Note:** The admin dashboard (`admin.php`) is not included in the current project structure. You would need to create this file separately if admin functionality is required.

If you have created `admin.php`, you can access it at:

1. Go to: `http://localhost/Hostel-Room-Booking/public/admin.php`
2. View statistics (total rooms, available, booked)
3. Try switching between tabs
4. Test adding a new room
5. Test updating room status

---

## ❗ Common Issues & Solutions

### Issue 1: "Connection failed" Error

**Problem:** Can't connect to database

**Solutions:**

- Check if MySQL is running in XAMPP/WAMP
- Verify `.env` file credentials are correct
- Make sure database `hostel_booking` exists
- Check username (usually `root`) and password (usually empty for XAMPP)

### Issue 2: CSS Not Loading

**Problem:** Page has no styling

**Solutions:**

- Check file path: `../assets/css/style.css` in your HTML
- Make sure `style.css` is in `assets/css/` folder
- Clear browser cache (Ctrl + Shift + R)
- Check browser console (F12) for errors

### Issue 3: Page Shows PHP Code

**Problem:** PHP code visible on page instead of executing

**Solutions:**

- Make sure Apache is running
- Access via `localhost`, not by opening file directly
- File must have `.php` extension
- Check if PHP is installed and enabled

### Issue 4: "Table doesn't exist" Error

**Problem:** SQL error about missing table

**Solutions:**

- Run the CREATE TABLE SQL commands in phpMyAdmin
- Check database name in `.env` matches actual database
- Verify you selected the correct database

### Issue 5: Booking Not Working

**Problem:** Form submits but nothing happens

**Solutions:**

- Check if `bookings` table exists
- Verify foreign key relationship between tables
- Look for SQL errors in browser or PHP error log
- Test with simple data first

---

## 📝 Missing Files Setup

### Files Not Included in Current Project

The following files are referenced in the original documentation but are not present in the current project structure:

1. **admin.php** - Admin dashboard for managing rooms and bookings
2. **success.php** - Success page after booking confirmation
3. **.env** - Environment file for database credentials
4. **.gitignore** - Git ignore file

### Creating Missing Files

If you need these files, you can create them based on the original documentation or implement them according to your specific requirements.

**For .env file:**

```ini
DB_SERVER=localhost
DB_USER=root
DB_PASS=
DB_NAME=hostel_booking
```

**For .gitignore file:**

```
# Environment files
.env

# Logs
*.log

# OS generated files
.DS_Store
Thumbs.db

# IDE files
.vscode/
.idea/
```

---

## 🎨 Customization Tips

### Change Colors

Edit `assets/css/style.css`:

- Main gradient: Lines 7-8 (background)
- Primary color: Search for `#667eea` and replace
- Secondary color: Search for `#764ba2` and replace

### Add More Room Types

If you have created `admin.php`, edit the line with room types:

```php
<option value="YourNewType">Your New Type</option>
```

Alternatively, you can modify the room types directly in the database or in the `rooms.php` file.

### Modify Pricing Display

Edit `public/rooms.php`, search for `number_format()` function

---

## 📚 Key Concepts for C++ Programmers

| C++ Concept               | PHP Equivalent                     | Example                           |
| ------------------------- | ---------------------------------- | --------------------------------- |
| `#include`                | `include` or `require`             | `include "header.php";`           |
| `cout <<`                 | `echo`                             | `echo "Hello";`                   |
| `cin >>`                  | `$_POST[]` or `$_GET[]`            | `$name = $_POST['name'];`         |
| Variables start with type | Variables start with `$`           | `$price = 1500;`                  |
| `for` loop                | `while` with fetch                 | `while ($row = $result->fetch())` |
| Arrays: `arr[0]`          | Arrays: `$arr[0]` or `$arr['key']` | `$row['price']`                   |
| Functions                 | Functions (similar)                | `function calculateTotal() {}`    |

---

## 🎯 Next Steps

1. ✅ Complete basic setup
2. ✅ Test all features
3. 🔲 Add user authentication (login system)
4. 🔲 Add payment integration
5. 🔲 Add email notifications
6. 🔲 Create user dashboard
7. 🔲 Add room images
8. 🔲 Implement search and filters

---

## 🆘 Need Help?

- Check PHP documentation: [php.net](https://www.php.net/)
- MySQL tutorial: [mysqltutorial.org](https://www.mysqltutorial.org/)
- XAMPP guide: [apachefriends.org](https://www.apachefriends.org/)

---

**Congratulations!** 🎉 You've successfully set up your Hostel Room Booking System!

The system is now ready to use. Start by accessing the homepage and exploring all the features.
