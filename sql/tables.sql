-- READIFY Database Schema

CREATE DATABASE IF NOT EXISTS readify;
USE readify;

-- ----------------------------
-- BOOKS TABLE
-- ----------------------------
CREATE TABLE IF NOT EXISTS books (
  book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  author VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(6,2) NOT NULL,
  cover_image VARCHAR(255) NOT NULL,
  PRIMARY KEY (book_id)
);

-- ----------------------------
-- USERS TABLE
-- ----------------------------
CREATE TABLE IF NOT EXISTS users (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  reg_date DATETIME NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE (email)
);
