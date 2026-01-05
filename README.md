
# 📚 Readify — PHP & MySQL Web Application

Readify is a PHP web application built as part of **Challenge 4 – Portfolio** for the module **Web Technologies EC149759/026**.

This project was developed step by step to demonstrate how a dynamic website works using **procedural PHP**, **MySQL**, **sessions**, and **Bootstrap**. The focus of the project is not just appearance, but understanding how authentication, access control, shopping carts, and orders work together in a real application.

---

## What this project does

The application allows users to create an account, log in, and interact with a simple online book store. Once logged in, users can browse books, add them to a cart, update quantities, complete a checkout, and view their past orders. Pages that require authentication are protected so only logged-in users can access them.

Sessions are used throughout the project to track the logged-in user and to store cart data while the user navigates between pages.

---

## User registration and login

Users can register by providing their first name, last name, email, and password. The password is securely stored in the database using hashing.

After registration, the user is automatically logged in by creating session variables and redirected to the home page. This improves the user experience and shows how sessions can be created immediately after inserting a new user into the database.

The login system validates credentials against the database and uses sessions to keep the user logged in across pages. If login fails, a clear error message is displayed. Users can also log out, which safely destroys the session and redirects them back to the home page.

---

## Session management and access control

Sessions are central to this project. A dedicated session bootstrap file ensures sessions are started safely across the application.

An authentication guard file is used to protect restricted pages such as the cart, checkout, and order history. If a user tries to access these pages without being logged in, they are redirected to the login page. After logging in, they are returned to the page they originally tried to access.

This demonstrates proper access control using PHP sessions.

---

## Product catalogue

Books are stored in the database and displayed dynamically on the home page. Each book includes a title, author, price, and cover image. Products are displayed using Bootstrap cards and a responsive grid layout that adapts to different screen sizes.

All product data shown on the page comes directly from the database.

---

## Shopping cart

The shopping cart is implemented using PHP sessions. When a user adds a book to the cart, the item is stored in the session along with its price and quantity.

Users can update quantities directly from the cart page. Setting a quantity to zero removes the item from the cart. Cart totals and subtotals are recalculated dynamically on each update.

A shared session-cart file ensures the cart is always initialised consistently across all cart-related pages.

---

## Checkout and orders

During checkout, the application calculates the total price of the cart and creates a new order in the database. Each item in the cart is stored in a separate order items table along with its quantity and price at the time of purchase.

Storing the price per order item ensures historical accuracy even if product prices change later.

After checkout, the cart is cleared and the user is redirected to the order history page.

---

## Order history

Logged-in users can view all their previous orders. Each order shows the order date, total amount, and the individual items included in the order.

Orders are retrieved using the user’s session ID, ensuring users can only see their own data. This page demonstrates database relationships and joins between orders, order items, and books.

---

## User interface and responsiveness

Bootstrap is used throughout the project to create a clean and responsive interface. The layout adapts correctly on desktop, tablet, and mobile devices.

The navigation bar changes based on whether the user is logged in. When logged in, it shows links to orders, cart, and checkout, as well as the user’s name. A cart badge dynamically displays the total number of items in the cart.

---

## Testing and verification

The project was tested manually by navigating through all user flows, including registration, login, cart updates, checkout, and order history. Responsive behaviour was verified using browser developer tools.

Basic Cypress configuration is included to demonstrate awareness of automated testing concepts covered in the module.

---

## Academic context


It demonstrates core concepts taught in the module, including procedural PHP, MySQL database integration, session handling, access control, and dynamic content generation.

---

## Project status

The project is fully functional. User authentication works correctly, sessions are handled safely, the shopping cart behaves as expected, orders are stored and displayed correctly, and the interface is responsive and easy to use.

---

## Author

Developed by **Raul Salvat**
Web Technologies
---

