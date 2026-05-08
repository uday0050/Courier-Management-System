# SpeedyParcel — Courier Management System

> A full-stack web application for end-to-end courier order management, built with PHP, MariaDB, and Bootstrap. Demonstrates relational database design, PL/SQL programming (triggers, stored procedures, cursors, functions), session-based authentication, and a two-tier user/admin architecture.

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [System Architecture](#3-system-architecture)
4. [Directory Structure](#4-directory-structure)
5. [Database Design](#5-database-design)
   - [ER Diagram (Textual)](#er-diagram-textual)
   - [Table Definitions](#table-definitions)
   - [Relationships & Constraints](#relationships--constraints)
6. [PL/SQL Programming Layer](#6-plsql-programming-layer)
   - [Triggers](#triggers)
   - [Stored Procedures](#stored-procedures)
   - [Stored Functions](#stored-functions)
   - [Exception Handling](#exception-handling)
7. [Application Features](#7-application-features)
   - [User Portal](#user-portal)
   - [Admin Portal](#admin-portal)
8. [Request–Response Flow](#8-requestresponse-flow)
9. [Pricing Logic](#9-pricing-logic)
10. [Setup & Installation](#10-setup--installation)
11. [Known Limitations & Security Notes](#11-known-limitations--security-notes)
12. [Future Enhancements](#12-future-enhancements)

---

## 1. Project Overview

SpeedyParcel is a courier management system that allows registered users to place courier orders, track delivery status, edit or cancel bookings, and contact support. A separate admin interface provides privileged access to view and delete any courier record or user account across the entire system.

The project was built as a DBMS course project to demonstrate:

- **Relational schema design** with normalization, primary/foreign keys, and referential integrity
- **PL/SQL constructs** — triggers, stored procedures, cursors, functions, and exception handling
- **PHP + MySQL integration** using the `mysqli` extension
- **Session-based authentication** for two distinct roles (user and admin)
- **File upload handling** for attaching item images to courier orders

---

## 2. Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 7.4 (procedural) |
| Database | MariaDB 10.4 (MySQL-compatible) |
| DB Interface | phpMyAdmin 5.0 + `mysqli` extension |
| Frontend | HTML5, CSS3, Bootstrap 4 |
| Typography | Google Fonts — Poppins, Segoe UI |
| Server | Apache (XAMPP / LAMP stack) |
| Session | PHP native `$_SESSION` |
| File Storage | Local filesystem (`dbimages/`) |

---

## 3. System Architecture

```
Browser
  │
  ▼
Apache HTTP Server (localhost)
  │
  ├── PHP Engine
  │     ├── Session management (session_start / $_SESSION)
  │     ├── Form processing ($_POST / $_GET)
  │     ├── File upload handling (move_uploaded_file)
  │     └── mysqli queries → MariaDB
  │
  └── MariaDB
        ├── Tables: users, login, admin, adlogin, courier, contacts, delivery_status
        ├── Triggers: update_delivery_status, prevent_duplicate_emails
        ├── Stored Procedures: fetch_admin(), insert_user()
        └── Stored Functions: get_user_count()
```

The application uses a classic **multi-page PHP** (MPP) pattern — each page is a self-contained PHP file that handles its own form submissions, database queries, and HTML rendering. There is no front-end framework or REST API; all data transfer is synchronous via HTTP POST/GET to the same or a sibling PHP file.

---

## 4. Directory Structure

```
DBMS_COURIER_PROJECT/
└── website/
    ├── index.php               # User login page + POST handler
    ├── register.php            # User registration form
    ├── session.php             # Session guard (included by protected pages)
    ├── dbconnection.php        # Single mysqli_connect() shared across pages
    ├── logout.php              # Destroys user session, redirects to index
    ├── resetpswd.php           # Password reset entry form
    ├── reset.php               # Password reset processor
    │
    ├── home/
    │   ├── home.php            # Authenticated landing page (service overview)
    │   ├── header.php          # Bootstrap navbar component (included everywhere)
    │   ├── footer.php          # Footer component
    │   ├── courierMenu.php     # Place new order — form + INSERT handler
    │   ├── trackMenu.php       # List own couriers (session-filtered SELECT)
    │   ├── status.php          # Per-courier delivery status (date comparison)
    │   ├── updationtable.php   # Pre-filled edit form (SELECT by c_id)
    │   ├── editdata.php        # UPDATE handler (called from updationtable form)
    │   ├── deletecourier.php   # DELETE courier by billno
    │   ├── price.php           # Static pricing reference table
    │   ├── profile.php         # Static user profile display
    │   └── contactUs.php       # Contact form (INSERT into contacts)
    │
    ├── admin/
    │   ├── adminlogin.php      # Admin login + POST handler (adlogin table)
    │   ├── dashboard.php       # Admin panel with navigation links
    │   ├── deletedata.php      # View ALL courier records + delete link
    │   ├── datadeleted.php     # DELETE courier by billno (admin-side)
    │   ├── deleteusers.php     # View all users + delete link
    │   ├── usersdeleted.php    # DELETE user by u_id (cascades to courier+login)
    │   ├── head.php            # Admin <head> imports (Bootstrap, fonts)
    │   └── logout.php          # Destroys admin session
    │
    ├── database/
    │   ├── courierdb.sql       # Full schema DDL + seed data (phpMyAdmin export)
    │   └── plsql.sql           # Triggers, stored procedures, functions
    │
    ├── css/
    │   └── style.css           # Global overrides
    ├── images/                 # Static UI assets (logos, banners)
    └── dbimages/               # User-uploaded courier item images
```

---

## 5. Database Design

### ER Diagram (Textual)

```
USERS ──────────────── LOGIN
  │  (1)          (1)   (FK u_id)
  │
  │ (1)
  ▼
COURIER ─────────────── DELIVERY_STATUS
  (c_id PK)        (1)   (FK c_id, CASCADE)
  (billno UNIQUE)

ADMIN ──────────────── ADLOGIN
  (a_id PK)   (1)  (1)  (FK a_id)

CONTACTS  (standalone — stores support messages)
```

### Table Definitions

#### `users`
Stores registered end-user accounts.

| Column | Type | Constraints |
|---|---|---|
| `u_id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `email` | VARCHAR(50) | NOT NULL, UNIQUE |
| `name` | VARCHAR(50) | — |
| `pnumber` | INT(14) | — |

#### `login`
Stores credentials separately from profile data.

| Column | Type | Constraints |
|---|---|---|
| `email` | VARCHAR(50) | — |
| `password` | VARCHAR(50) | — |
| `u_id` | INT(11) | FK → `users(u_id)` ON DELETE CASCADE |

#### `admin`
Stores administrator accounts.

| Column | Type | Constraints |
|---|---|---|
| `a_id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `email` | VARCHAR(50) | NOT NULL, UNIQUE |
| `name` | VARCHAR(50) | — |
| `pnumber` | INT(14) | — |

#### `adlogin`
Stores admin credentials, mirroring the user/login split.

| Column | Type | Constraints |
|---|---|---|
| `email` | VARCHAR(50) | — |
| `password` | VARCHAR(50) | — |
| `a_id` | INT(11) | FK → `admin(a_id)` |

#### `courier`
Core business entity — one row per courier booking.

| Column | Type | Constraints |
|---|---|---|
| `c_id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `u_id` | INT(11) | FK → `users(u_id)` ON DELETE CASCADE |
| `semail` | VARCHAR(50) | Sender email |
| `remail` | VARCHAR(50) | Receiver email |
| `sname` | VARCHAR(50) | Sender full name |
| `rname` | VARCHAR(50) | Receiver full name |
| `sphone` | VARCHAR(20) | Sender phone |
| `rphone` | VARCHAR(20) | Receiver phone |
| `saddress` | VARCHAR(50) | Sender address |
| `raddress` | VARCHAR(50) | Receiver address |
| `weight` | INT(11) | Package weight (kg) |
| `billno` | INT(11) | NOT NULL, UNIQUE (payment transaction ID) |
| `image` | TEXT | Filename in `dbimages/` |
| `date` | DATE | NOT NULL (expected delivery date) |

#### `delivery_status`
Auto-populated by trigger; tracks per-courier delivery state.

| Column | Type | Constraints |
|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT |
| `c_id` | INT | FK → `courier(c_id)` ON DELETE CASCADE |
| `status` | VARCHAR(20) | `'Today'` or `'Future'` |

#### `contacts`
Stores messages submitted via the Contact Us form.

| Column | Type | Constraints |
|---|---|---|
| `id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `email` | VARCHAR(50) | NOT NULL |
| `subject` | VARCHAR(30) | NOT NULL |
| `msg` | VARCHAR(300) | NOT NULL |

### Relationships & Constraints

```sql
-- Courier belongs to a user; deleting a user removes all their couriers
ALTER TABLE courier
  ADD CONSTRAINT courier_ibfk_1
  FOREIGN KEY (u_id) REFERENCES users(u_id) ON DELETE CASCADE;

-- Login record belongs to a user; deleting user removes login
ALTER TABLE login
  ADD CONSTRAINT login_ibfk_1
  FOREIGN KEY (u_id) REFERENCES users(u_id) ON DELETE CASCADE;

-- Admin login belongs to an admin
ALTER TABLE adlogin
  ADD CONSTRAINT adlogin_ibfk_1
  FOREIGN KEY (a_id) REFERENCES admin(a_id);

-- Delivery status is tied to a courier; cascade-deleted with it
FOREIGN KEY (c_id) REFERENCES courier(c_id) ON DELETE CASCADE;
```

---

## 6. PL/SQL Programming Layer

All PL/SQL constructs live in `website/database/plsql.sql`.

### Triggers

#### `update_delivery_status` — AFTER INSERT on `courier`

Automatically inserts a row into `delivery_status` whenever a new courier booking is created. The status is set based on whether the booking date matches today's date.

```sql
DELIMITER //
CREATE TRIGGER update_delivery_status
AFTER INSERT ON courier
FOR EACH ROW
BEGIN
    DECLARE delivery_status VARCHAR(20);
    IF NEW.date = CURDATE() THEN
        SET delivery_status = 'Today';
    ELSE
        SET delivery_status = 'Future';
    END IF;
    INSERT INTO delivery_status (c_id, status)
    VALUES (NEW.c_id, delivery_status);
END //
DELIMITER ;
```

**Purpose:** Decouples status tracking from the application layer — the database enforces that every courier booking always has a corresponding status record, regardless of how the INSERT was performed.

---

#### `prevent_duplicate_emails` — BEFORE INSERT on `users`

Guards against duplicate email addresses at the database level (in addition to the UNIQUE constraint), with a descriptive application error.

```sql
CREATE OR REPLACE TRIGGER prevent_duplicate_emails
BEFORE INSERT ON users
FOR EACH ROW
DECLARE
    email_count NUMBER;
BEGIN
    SELECT COUNT(*) INTO email_count FROM users WHERE email = :NEW.email;
    IF email_count > 0 THEN
        RAISE_APPLICATION_ERROR(-20001, 'Email already exists. Please use a different email.');
    END IF;
END;
```

**Note:** Uses Oracle PL/SQL syntax (`RAISE_APPLICATION_ERROR`, `:NEW`). This was written for a PL/SQL concepts demonstration; the `UNIQUE` constraint on `users.email` provides equivalent enforcement in MariaDB.

---

### Stored Procedures

#### `fetch_admin()` — Cursor-Based Admin Data Retrieval

Demonstrates an **explicit cursor** that iterates over all admin rows and prints each record. Showcases `DECLARE CURSOR`, `OPEN`, `FETCH`, `LEAVE` loop, and `CLOSE`.

```sql
DELIMITER //
CREATE PROCEDURE fetch_admin()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE a_id_val INT;
    DECLARE email_val VARCHAR(50);
    DECLARE name_val VARCHAR(50);

    DECLARE admin_cursor CURSOR FOR
        SELECT a_id, email, name FROM admin;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN admin_cursor;
    read_loop: LOOP
        FETCH admin_cursor INTO a_id_val, email_val, name_val;
        IF done THEN LEAVE read_loop; END IF;
        SELECT CONCAT('Admin ID: ', a_id_val, ', Email: ', email_val, ', Name: ', name_val);
    END LOOP;
    CLOSE admin_cursor;
END //
DELIMITER ;

CALL fetch_admin();
```

---

#### `insert_user(p_email, p_name, p_pnumber)` — Parameterized User Insertion

A reusable procedure to add new users, separating the DML from the calling layer.

```sql
DELIMITER //
CREATE PROCEDURE insert_user (
    p_email VARCHAR(50),
    p_name VARCHAR(50),
    p_pnumber INT
)
BEGIN
    INSERT INTO users (email, name, pnumber)
    VALUES (p_email, p_name, p_pnumber);
    SELECT 'User inserted successfully.';
END //
DELIMITER ;

CALL insert_user('Adi@yahoo.com', 'Aaditya', 123456789);
```

---

### Stored Functions

#### `get_user_count()` → INT

A scalar function that returns the total number of registered users. Demonstrates `RETURNS`, `DECLARE`, and `RETURN` in MySQL's stored function syntax.

```sql
DELIMITER //
CREATE FUNCTION get_user_count() RETURNS INT
BEGIN
    DECLARE user_count INT;
    SELECT COUNT(*) INTO user_count FROM users;
    RETURN user_count;
END //
DELIMITER ;

SELECT get_user_count();
```

---

### Exception Handling

Demonstrates Oracle-style structured exception handling blocks covering three common scenarios: duplicate index violation, no-data-found, and a general catch-all.

```sql
DECLARE
    v_user_count INT;
BEGIN
    SELECT COUNT(*) INTO v_user_count FROM users;
    DBMS_OUTPUT.PUT_LINE('Number of users: ' || v_user_count);
EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN
        DBMS_OUTPUT.PUT_LINE('Error: Duplicate value encountered.');
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No users found.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('An error occurred: ' || SQLERRM);
END;
```

---

## 7. Application Features

### User Portal

| Feature | File(s) | Description |
|---|---|---|
| Login | `index.php` | Email + password auth against `login` table; stores `$_SESSION['uid']` and `$_SESSION['emm']` |
| Registration | `register.php` | Collects name, phone, email, password; dual-table INSERT into `users` + `login` |
| Password Reset | `resetpswd.php`, `reset.php` | Email-based password update |
| Place Order | `courierMenu.php` | Multi-field form collecting sender/receiver details, weight, payment ID, date, item image; INSERT into `courier` |
| View Orders | `trackMenu.php` | Session-filtered `SELECT * FROM courier WHERE semail = $_SESSION['emm']`; displays table with Edit / Delete / Check Status actions |
| Check Status | `status.php` | Fetches courier by `c_id` (GET param); compares `courier.date` with `CURDATE()` — displays "On The Way" or "Items Delivered" |
| Edit Order | `updationtable.php` → `editdata.php` | Pre-fills form with existing record; UPDATE query on submit with new image upload |
| Delete Order | `deletecourier.php` | DELETE FROM courier WHERE billno = $bb (GET param) |
| Pricing | `price.php` | Static weight-to-price reference table with payment method details |
| Contact Us | `contactUs.php` | INSERT into `contacts` table; subject + message + email |
| Profile | `profile.php` | Static user profile card (Bootstrap card layout) |
| Logout | `logout.php` | `session_destroy()` + redirect to `index.php` |

### Admin Portal

| Feature | File(s) | Description |
|---|---|---|
| Admin Login | `admin/adminlogin.php` | Authenticates against `adlogin` table; separate `$_SESSION['uid']` context |
| Dashboard | `admin/dashboard.php` | Central navigation hub with links to all admin functions |
| View All Couriers | `admin/deletedata.php` | `SELECT * FROM courier` (no user filter) — full system view |
| Delete Courier | `admin/datadeleted.php` | DELETE FROM courier WHERE billno = $bb (GET param) |
| View All Users | `admin/deleteusers.php` | Lists all users from `users` table |
| Delete User | `admin/usersdeleted.php` | DELETE FROM users WHERE u_id = $uid; cascades to `login` and `courier` rows |
| Admin Logout | `admin/logout.php` | Session destroy + redirect |

---

## 8. Request–Response Flow

### User Login Flow

```
POST index.php (email, password)
  └─► SELECT * FROM login WHERE email=? AND password=?
        ├─ 0 rows → JS alert + reload index.php
        └─ 1 row  → $_SESSION['uid'] = u_id
                    $_SESSION['emm'] = email
                    redirect → home/home.php
```

### Place Courier Order Flow

```
GET  courierMenu.php          → renders order form
POST courierMenu.php (form)
  └─► INSERT INTO courier (u_id, semail, remail, sname, rname,
                           sphone, rphone, saddress, raddress,
                           weight, billno, image, date)
        └─► TRIGGER: update_delivery_status fires AFTER INSERT
              └─► INSERT INTO delivery_status (c_id, status='Today'|'Future')
```

### Track + Status Flow

```
GET  trackMenu.php
  └─► SELECT * FROM courier WHERE semail = $_SESSION['emm']
        └─► renders table; each row has "Check Status" link

GET  status.php?sidd={c_id}
  └─► SELECT date FROM courier WHERE c_id = $sidd
        ├─ date == CURDATE() → "On The Way..."
        └─ date != CURDATE() → "Items Delivered"
```

### Admin Delete User Flow (Cascade)

```
GET  usersdeleted.php?uid={u_id}
  └─► DELETE FROM users WHERE u_id = $uid
        ├─► CASCADE → DELETE FROM login   WHERE u_id = $uid
        └─► CASCADE → DELETE FROM courier WHERE u_id = $uid
                └─► CASCADE → DELETE FROM delivery_status WHERE c_id IN (deleted courier ids)
```

---

## 9. Pricing Logic

Pricing is weight-based and displayed statically in `price.php`. Users are directed to pay via UPI/GPay/PhonePe before placing an order, submitting their transaction ID as the `billno` field (enforced UNIQUE in the `courier` table).

| Weight Range | Price (INR) |
|---|---|
| 0 – 1 kg | ₹120 |
| 1 – 2 kg | ₹200 |
| 2 – 4 kg | ₹250 |
| 4 – 5 kg | ₹300 |
| 5 – 7 kg | ₹400 |
| 7 kg and above | ₹500 |

---

## 10. Setup & Installation

### Prerequisites

- XAMPP (or any Apache + PHP 7.4+ + MariaDB 10.4+ stack)
- phpMyAdmin (bundled with XAMPP)

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/uday-superagi/DBMS_COURIER_PROJECT.git
```

**2. Move to web server root**
```bash
cp -r DBMS_COURIER_PROJECT/website /Applications/XAMPP/htdocs/courierproject
# or on Linux:
cp -r DBMS_COURIER_PROJECT/website /var/www/html/courierproject
```

**3. Import the database schema**

Open phpMyAdmin → Create database named `courierdb.sql` → Import `website/database/courierdb.sql`

Then run the PL/SQL script in the SQL tab:
```
website/database/plsql.sql
```

**4. Verify DB connection**

Open `website/dbconnection.php` and confirm the connection parameters match your local setup:
```php
$dbcon = mysqli_connect('localhost', 'root', '', 'courierdb.sql');
```

**5. Set write permissions for image uploads**
```bash
chmod 777 /path/to/courierproject/dbimages/
```

**6. Access the application**

| URL | Page |
|---|---|
| `http://localhost/courierproject/index.php` | User login |
| `http://localhost/courierproject/admin/adminlogin.php` | Admin login |

**Default credentials (from seed data)**

| Role | Email | Password |
|---|---|---|
| User | `premkumar1215225@gmail.com` | `12345` |
| User | `love@gmail.com` | `12345` |
| Admin | `admin1@gmail.com` | `12345` |
| Admin | `admin2@gmail.com` | `12345` |

---

## 11. Known Limitations & Security Notes

This project was built for academic/DBMS demonstration purposes. The following issues exist and are acknowledged:

| Issue | Location | Description |
|---|---|---|
| SQL Injection | All query files | Variables are interpolated directly into SQL strings with no prepared statements or parameterization |
| Plaintext passwords | `login`, `adlogin` tables | Passwords stored and compared as plaintext — no hashing (bcrypt/Argon2 absent) |
| Weak session guard | `session.php` | Session validation checks only for existence of `$_SESSION['uid']`, not integrity |
| IDOR risk | `status.php`, `deletecourier.php` | `c_id` and `billno` are passed as GET params with no ownership verification |
| No CSRF protection | All POST forms | No CSRF tokens on any form submissions |
| File upload | `editdata.php` | No MIME-type validation on uploaded files — any file extension accepted |
| Hardcoded u_id | `courierMenu.php` | `u_id` is hardcoded as `'4'` in the INSERT query instead of reading from session |

These are standard improvements that would be applied in a production system using prepared statements (`mysqli_prepare`/PDO), `password_hash()`, and proper input validation.

---

## 12. Future Enhancements

- Replace all raw queries with PDO prepared statements to eliminate SQL injection
- Hash passwords with `password_hash(BCRYPT)` at registration; verify with `password_verify()`
- Add real-time delivery status updates (cron job or WebSockets) instead of date-only comparison
- Implement email notifications (PHPMailer) to sender/receiver on order placement and status change
- Extend the trigger layer to log every status transition into a `status_history` audit table
- Add pagination to the admin courier and user tables
- Introduce role-based access control (RBAC) to support multiple admin privilege levels
- Migrate to an MVC pattern (Laravel or CodeIgniter) to separate business logic from presentation
- Replace static profile page with dynamic data fetched from `users` table via session `u_id`

---

## Author

**Uday** — [GitHub @uday-superagi](https://github.com/uday-superagi)

Built as a Database Management Systems (DBMS) course project demonstrating relational schema design, PL/SQL programming constructs, and PHP-MySQL full-stack web development.
