<?php
// --------------------------------------------------
// Add to Cart Action – READIFY
// Adds a selected book to the user's session cart
// --------------------------------------------------

// Protect this page so only logged-in users can add items
require "includes/auth_guard.php";

// Ensure session and cart are initialised
require "includes/session-cart.php";

// Connect to the database
require "connect_db.php";

// --------------------------------------------------
// Validate book ID from URL
// --------------------------------------------------
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    // If the ID is missing or invalid, return to home page
    header("Location: index.php");
    exit;
}

// Convert book ID to integer for safety
$book_id = (int) $_GET["id"];

// --------------------------------------------------
// Fetch book details from the database
// --------------------------------------------------
$query = "SELECT book_id, title, price FROM books WHERE book_id = $book_id";
$result = mysqli_query($link, $query);

// If book does not exist, redirect back to home page
if (!$result || mysqli_num_rows($result) !== 1) {
    header("Location: index.php");
    exit;
}

// Store book data in an array
$book = mysqli_fetch_assoc($result);

// --------------------------------------------------
// Add book to cart or increase quantity if already added
// --------------------------------------------------
if (isset($_SESSION["cart"][$book_id])) {
    // If the book is already in the cart, increase quantity
    $_SESSION["cart"][$book_id]["quantity"]++;
} else {
    // Otherwise, add the book to the cart
    $_SESSION["cart"][$book_id] = [
        "title"    => $book["title"],
        "price"    => (float) $book["price"],
        "quantity" => 1
    ];
}

// --------------------------------------------------
// Redirect user back to previous page
// --------------------------------------------------
$redirect = $_SERVER["HTTP_REFERER"] ?? "index.php";
header("Location: $redirect");
exit;
?>
