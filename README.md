
# 📚 Readify — PHP & MySQL eCommerce Application

Readify is a dynamic PHP web application developed as part of **Challenge 4 – Portfolio** for  
**Web Technologies EC149759/026**.

The project demonstrates core web development concepts including **user authentication**,  
**session management**, **access control**, and a **database-driven product and order system**  
using **procedural PHP** and **MySQL**.

---

## 🎯 Project Objective

The objective of this project is to create a PHP web application that allows users to:

- Register an account
- Log in securely
- Access protected pages
- Browse products (books)
- Add products to a shopping cart
- Complete a checkout process
- Store orders in a relational database

Only authenticated users can access protected pages.

---

## 🧩 Key Features

### 👤 User Authentication
- User registration with validation
- Secure login using email and password
- Passwords stored using hashing
- Logout functionality that ends the session

### 🔐 Session Management & Access Control
- PHP sessions track logged-in users
- Session variables identify authenticated users
- Protected pages redirect unauthenticated users to the login page

### 📖 Product Catalogue
- Products are stored in the database (`books` table)
- Each product includes:
  - Title
  - Author
  - Description
  - Price
  - Cover image

### 🛒 Shopping Cart
- Session-based shopping cart
- Users can add multiple items
- Quantities are tracked per product
- Cart totals are calculated dynamically

### 💳 Checkout & Orders
- Orders are saved to the database
- Each order is linked to the logged-in user
- Order items store:
  - Book reference
  - Quantity
  - Price at time of purchase
- Prices are stored per order item to preserve historical accuracy

---

## 🗄️ Database Structure

Database name: **`readify`**

### Tables

#### `users`
Stores registered users.
- `user_id` (Primary Key)
- `first_name`
- `last_name`
- `email`
- `password`
- `reg_date`

#### `books`
Stores available products.
- `book_id` (Primary Key)
- `title`
- `author`
- `description`
- `price`
- `cover_image`

#### `orders`
Stores order headers.
- `order_id` (Primary Key)
- `user_id` (linked to users)
- `total`
- `order_date`

#### `order_items`
Stores individual items per order.
- `item_id` (Primary Key)
- `order_id` (linked to orders)
- `book_id` (linked to books)
- `quantity`
- `price`

---

## 🔗 Data Relationships

- One user can place many orders
- One order can contain many order items
- Each order item references a book
- Order item prices are stored independently from current product prices

---

## 📂 Project Structure

```text
readify/
├── css/
├── img/
├── includes/
├── cypress/
├── sql/
│
├── index.php
├── register.php
├── login.php
├── login_action.php
├── logout.php
├── added.php
├── cart.php
├── checkout.php
├── order_history.php
├── connect_db.php
│
├── package.json
├── package-lock.json
├── cypress.config.js
└── README.md
````

---

## 🧪 Testing

Basic end-to-end testing is configured using **Cypress** to validate:

* Page loading
* User navigation
* Authentication flow

Cypress is included as a development tool to support testing concepts covered in the module.

---

## 🚀 How to Run the Project

1. Clone the repository
2. Place the project inside:

   ```
   C:\xampp\htdocs\
   ```
3. Start **Apache** and **MySQL** using XAMPP
4. Import the database from the `sql` folder using phpMyAdmin
5. Open the project in a browser:

   ```
   http://localhost/readify
   ```

---

## 🎓 Academic Context

This project was developed for:

**Challenge 4 – Portfolio**
**Web Technologies EC149759/026**

It demonstrates:

* Procedural PHP
* MySQL database integration
* User authentication
* Session management
* Access control to protected pages
* Dynamic, database-driven content

---

## ✅ Project Status

✔ User registration implemented
✔ Secure login and logout
✔ Session-protected pages
✔ Products displayed dynamically
✔ Shopping cart functional
✔ Checkout and orders stored
✔ Database relationships working correctly

---

## 🙌 Author

Developed by **[Your Name]**
Web Technologies — Portfolio Project

```

