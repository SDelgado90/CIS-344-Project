-- 1. Create the Database
CREATE DATABASE IF NOT EXISTS childcare_db;
USE childcare_db;

-- 2. Classrooms Table (Includes Age Ranges and Capacity Constraints)
CREATE TABLE classrooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(50) NOT NULL,
    age_range VARCHAR(50) NOT NULL,
    capacity INT NOT NULL
);

-- 3. Guardians Table (Secure Personal Data Management)
CREATE TABLE guardians (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    current_balance DECIMAL(10, 2) DEFAULT 0.00
);

-- 4. Children Table (Linked to Classrooms via Foreign Key)
CREATE TABLE children (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    classroom_id INT,
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id) ON DELETE SET NULL
);

-- 5. Enrollment Bridge Table (Linking Children to Guardians)
-- This allows for "Joins" to show which parent belongs to which child
CREATE TABLE enrollment (
    child_id INT,
    guardian_id INT,
    PRIMARY KEY (child_id, guardian_id),
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE,
    FOREIGN KEY (guardian_id) REFERENCES guardians(id) ON DELETE CASCADE
);

-- 6. Attendance Table (For Transactions and Tracking)
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    child_id INT,
    status ENUM('Present', 'Absent', 'Late') NOT NULL,
    log_date DATE DEFAULT (CURRENT_DATE),
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 7. Invoices Table (For Billing Transactions)
CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guardian_id INT,
    amount DECIMAL(10, 2) NOT NULL,
    billing_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Paid', 'Unpaid') DEFAULT 'Unpaid',
    FOREIGN KEY (guardian_id) REFERENCES guardians(id)
);

-- 8. Seed Data: Populate the 6 Color-Coded Rooms
-- Based on the 3 month to 3 year age split
INSERT INTO classrooms (room_name, age_range, capacity) VALUES 
('Red Room', '3-12 Months', 4),
('Blue Room', '12-18 Months', 6),
('Green Room', '18-24 Months', 8),
('Yellow Room', '2 Years', 10),
('Orange Room', '2.5 Years', 12),
('Purple Room', '3 Years', 15);
