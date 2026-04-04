Childcare Center Management System
CIS 344 - Group Project

Group Members:Sasha Delgado & Rasel Ali

Overview: This application is structured manage a daycare center for children aged 3 months to 3 years. It automates room assignments based on age, tracks attendance using relational joins, and processes billing via secure SQL transactions.

Installation & Setup Instructions;
To run this application locally, follow these steps:

Prerequisites: Install [XAMPP] (or any WAMP/MAMP stack) to run Apache and MySQL.
Database Configuration:
1. Open phpMyAdmin.
2. Create a new database named `childcare_db`.
3. Go to the Import tab and select the `database.sql` file in the repository.

Application Setup:
1. Copy the repository into your `htdocs` folder.
2. Open `includes/db_connect.php` and verify the database credentials (default is `root` with no password).

Accessing the App:
Copy and paste the link in your browser;  `http://localhost/CIS-344-Project/index.php`.

 Core Features
- Security: Implemented PDO Prepared Statements in `enrollment.php` to prevent SQL Injection.
- Joins: The `attendance.php` file utilizes a 4-table `JOIN` to link Children, Guardians, and Classrooms.
- Transactions:`billing.php` uses `beginTransaction()` and `commit()` to ensure financial data integrity.
- Automated Logic: Children are automatically assigned to color-coded rooms based on their age in months.

Repository Structure
- `/css`: UI styling and color-coded room classes.
- `/includes`: Database connection logic (`db_connect.php`).
- `/sql`: Database schema and initial seed data.
- Root: Functional PHP pages (`index.php`, `enrollment.php`, etc.).
