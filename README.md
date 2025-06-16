
# 🧳 Lost & Found Hub – Web Application

## 📋 Overview

Lost & Found Hub is a PHP-based web application that allows users to report and recover lost or found items within a closed community like a university, school, or office. It offers easy item reporting, search functionality, admin control, image upload, and email notifications to help reunite people with their belongings.

---

## 🛠 Features

- 🔐 **User Authentication** – Register and login securely
- 📝 **Post Lost or Found Items** – With title, description, date, location, and photo
- 🔍 **Search Items** – By title or location
- 📸 **Image Upload** – Attach photos of lost or found items
- 🧑‍💼 **Admin Dashboard** – Manage user posts and delete items
- 📧 **Email Notifications** – Alert users if a similar item is found
- 💡 **Role-Based Access Control** – Separate views for users and admins

---

## 👨‍💻 Technologies Used

| Category     | Tools                          |
|--------------|--------------------------------|
| Frontend     | HTML, CSS, JavaScript          |
| Backend      | PHP                            |
| Database     | MySQL                          |
| Others       | AJAX, JSON, Sessions, Cookies  |
| Extra        | PHP `mail()` or PHPMailer for email alerts |

---

## 🗃️ Database Structure

### 🔐 `users` Table
- `user_id` (Primary Key)
- `name`
- `email`
- `password` (Hashed)
- `role` (user/admin)

### 📦 `items` Table
- `item_id` (Primary Key)
- `title`
- `description`
- `status` (lost/found)
- `date_lost_found`
- `location`
- `image_path`
- `user_id` (Foreign Key)

---

## 📁 Folder Structure

```
lost_found/
├── index.php
├── register.php
├── login.php
├── dashboard.php
├── post_item.php
├── view_items.php
├── logout.php
├── admin/
│   └── admin_dashboard.php
├── includes/
│   ├── db.php
│   ├── auth.php
│   └── functions.php
├── assets/
│   └── style.css
└── images/
```

---

## 🚀 Installation Guide

1. Clone or copy this project into your XAMPP `htdocs/` directory:
   ```
   C:\xampp\htdocs\lost_found
   ```

2. Start **Apache** and **MySQL** in XAMPP Control Panel

3. Go to **phpMyAdmin** and create a database:
   ```sql
   CREATE DATABASE lost_and_found;
   ```

4. Import the database structure:
   - Create `users` and `items` tables (see above)

5. Edit `includes/db.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = ""; // default in XAMPP
   $dbname = "lost_and_found";
   ```

6. Open in browser:
   ```
   http://localhost/lost_found/
   ```

---

## 🔑 Default Admin Credentials

You can insert an admin manually using this SQL:

```sql
INSERT INTO users (name, email, password, role)
VALUES ('admin', 'admin@example.com', '<hashed_password>', 'admin');
```

To generate a hashed password:
```php
echo password_hash("admin123", PASSWORD_DEFAULT);
```

---

## ✅ Future Improvements (Optional)

- Pagination in item listing
- SMS or push notifications
- Forgot password functionality
- Report abuse/spam feature
- Responsive design for mobile use

---

## 📄 License

This project is for educational use under the MIT License. You may modify and distribute for non-commercial use.

---

## 🙌 Acknowledgements

Developed by:
- Prayojan Ghimire
- Nabin Ghimire
- Prashant Adhikari
- Dikshya Thakur
- Salina Karki

Under the guidance of [Instructor's Name], as part of Web Application Programming coursework.
