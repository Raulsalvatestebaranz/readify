-- READIFY Database Schema
-- Course-level, procedural PHP compatible

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
