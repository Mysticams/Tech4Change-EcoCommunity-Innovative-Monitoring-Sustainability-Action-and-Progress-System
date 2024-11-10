CREATE DATABASE IF NOT EXISTS authentication;
USE authentication;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('user', 'admin') NOT NULL
);

-- Insert sample users with hashed passwords
INSERT INTO users (username, password, email, role) VALUES 
('admin_user', '12345678', 'admin@example.com', 'admin'), 
('test_user', '87654321', 'user@example.com', 'user');
