create database db_batch8_capstone;

use db_batch8_capstone

-- Tbale: Users
CREATE TABLE Users (
    user_id INT PRIMARY KEy AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer'
);

