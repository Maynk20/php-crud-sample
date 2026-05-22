# Employee Portal — Passkey-Based Management System

A full-stack PHP + MySQL web application that lets employees self-register and log in using auto-generated numeric passkeys. Passkeys are emailed via **PHPMailer + Gmail SMTP** on registration.

---

## 👨‍💻 Developer Information

- **Name:** Mayank Thakkar
- **Contact:** +91 9998920070
- **GitHub:** [GitHub Profile](https://github.com/maynk20)

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 Passkey Authentication | Employees log in with a 4-digit numeric passkey — no traditional password needed |
| 📧 Email Delivery | Passkey is automatically emailed to the employee's inbox on successful registration |
| 📋 Employee Dashboard | Logged-in users can view a full table of all employee records |
| ➕ Register | Add a new employee — name, email, phone, gender, date of birth |
| ✏️ Edit | Update any employee's details inline via a pre-filled form |
| 🗑️ Delete | Remove an employee record with a confirmation prompt |
| 🛠️ Data Utility | One-off tool to normalize the `gender` column to lowercase |

---

## 🗂️ File Structure

```
emp/
├── index.php                     # Landing page — Login / Register CTAs
├── db.php                        # MySQL connection (mysqli)
├── readme.md                     # You are here
├── emp.zip                       # Project archive / backup
│
├── auth/
│   └── login.php                 # Passkey login form + authentication logic
│
├── crud/
│   ├── insert.php                # New employee registration form + DB insert + email
│   ├── main.php                  # Employee dashboard — lists all records
│   ├── update.php                # Edit employee details form + DB update
│   └── delete.php                # Delete employee record by ID
│
├── assets/
│   ├── styles.css                # Global CSS (dark-mode, cards, tables, forms)
│   └── footer.php                # Shared footer partial
│
├── plugins/
│   ├── email_config.php          # PHPMailer setup + sendEmail() helper function
│   └── PHPMailer-master/         # PHPMailer library (extracted from zip)
│       └── PHPMailer-master/
│           └── src/
│               ├── Exception.php
│               ├── PHPMailer.php
│               └── SMTP.php
│
└── tools/
    └── lowercase_gender.php      # One-off DB normalization script (gender → lowercase)
```

---

## 🧱 Technology Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 7.4+ (MySQLi, PDO-ready) |
| **Database** | MySQL 5.7+ |
| **Web Server** | Apache (XAMPP) |
| **Email** | PHPMailer 6.x — Gmail SMTP (STARTTLS, port 587) |
| **Frontend** | HTML5, Vanilla CSS, Bootstrap Icons (CDN) |
| **Session State** | PHP Cookies (`username` cookie, 24 h TTL) |

---

## ⚙️ Database Schema

Database name: **`emp`**, Table: **`user`**

| Column | Type | Notes |
|---|---|---|
| `id` | INT AUTO_INCREMENT | Primary key |
| `name` | VARCHAR | Employee full name |
| `email` | VARCHAR | Used for passkey delivery |
| `phn` | BIGINT | 10-digit mobile number |
| `gender` | VARCHAR | Stored as lowercase (`male` / `female`) |
| `dob` | DATE | Date of birth |
| `passkey` | INT | Random 4-digit number (`rand(1000, 10000)`) |

```sql
CREATE DATABASE IF NOT EXISTS emp;
USE emp;

CREATE TABLE user (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(100)  NOT NULL,
    email   VARCHAR(150)  NOT NULL,
    phn     BIGINT,
    gender  VARCHAR(10),
    dob     DATE,
    passkey INT           NOT NULL
);
```

---

## 🚀 Installation

### Prerequisites
- XAMPP (Apache + PHP 7.4+ + MySQL)
- A Gmail account with an **App Password** enabled (2FA required)

### Steps

1. **Place the project** in your XAMPP `htdocs` folder:
   ```
   C:\xampp\htdocs\MTC\Tutorial\crud\emp\
   ```

2. **Create the database** — open phpMyAdmin (`http://localhost/phpmyadmin`) and run the SQL above, or import a dump if you have one.

3. **Configure the database** connection in [`db.php`](db.php):
   ```php
   $db_server = "localhost";
   $db_user   = "root";
   $db_pass   = "";          // set your MySQL password if needed
   $db_name   = "emp";
   ```

4. **Configure email** in [`plugins/email_config.php`](plugins/email_config.php):
   ```php
   define('GMAIL_EMAIL',    'you@gmail.com');
   define('GMAIL_PASSWORD', 'your-16-char-app-password');
   ```
   > ⚠️ **Security**: Never commit real credentials to version control. Move these to a `.env` file or use `$_ENV` in production.

5. **Start XAMPP** (Apache + MySQL) and visit:
   ```
   http://localhost/MTC/Tutorial/crud/emp/
   ```

---

## 🔄 User Flow

```
Landing Page (index.php)
        │
        ├─── Register ──► insert.php
        │                  ├─ Collect: name, email, phone, gender, DOB
        │                  ├─ Generate passkey (rand 1000–10000)
        │                  ├─ INSERT into `user`
        │                  ├─ Send passkey via email (PHPMailer)
        │                  └─ Redirect → login.php
        │
        └─── Login ─────► login.php
                           ├─ Enter passkey
                           ├─ SELECT WHERE passkey matches
                           ├─ Set cookie: `username` (24h)
                           └─ Redirect → main.php (Dashboard)

Dashboard (main.php)
        ├─ View all employees (SELECT * FROM user)
        ├─ Edit ──────────► update.php?id={id}  → UPDATE → main.php
        └─ Delete ────────► delete.php?id={id}  → DELETE → main.php
```

---

## 🛠️ Utility Scripts

### `tools/lowercase_gender.php`
A one-time data-hygiene script that normalises legacy `gender` values to lowercase and trims whitespace.

```
# Preview (safe — no changes):
http://localhost/MTC/Tutorial/crud/emp/tools/lowercase_gender.php

# Execute normalization:
http://localhost/MTC/Tutorial/crud/emp/tools/lowercase_gender.php?confirm=1
```

---

## 📧 Email Template

On registration, each new employee receives an HTML email:

- **Subject**: `Your Login Passkey — Employee Portal`
- **From**: configured Gmail account
- **Body**: Personalised HTML block with the employee's name and their passkey displayed prominently

---

## ⚠️ Known Issues / Future Improvements

- [ ] Passkey range is only 1000–10000 — consider a wider or alphanumeric token
- [ ] No session-based access control on `main.php`, `update.php`, `delete.php` — a logged-out user can still access these directly
- [ ] `db.php` error message (`die("Shit")`) should be replaced with a user-friendly message in production
- [ ] `delete.php` error message (`echo "Shit"`) should be replaced with a proper error response
- [ ] Gmail App Password is hardcoded — move to environment variables before deploying
- [ ] No CSRF protection on forms

---

## 📋 Requirements

- PHP **7.4** or higher
- MySQL **5.7** or higher
- Apache Web Server (XAMPP recommended for local dev)
- Gmail account with **2-Step Verification** and an **App Password**
- Modern web browser (Chrome, Firefox, Edge)

---

## 📄 License

Open Source — free for educational and personal use.

---

*Built by Mayank Thakkar as a PHP CRUD tutorial project.*