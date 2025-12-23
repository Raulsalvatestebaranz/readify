-- READIFY Database Schema

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
-- ----------------------------
-- ORDERS TABLE
-- ----------------------------
CREATE TABLE IF NOT EXISTS orders (
  order_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  total DECIMAL(8,2) NOT NULL,
  order_date DATETIME NOT NULL,
  PRIMARY KEY (order_id)
);

-- ----------------------------
-- ORDER ITEMS TABLE
-- ----------------------------
CREATE TABLE IF NOT EXISTS order_items (
  item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  order_id INT UNSIGNED NOT NULL,
  book_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  price DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (item_id)
);
