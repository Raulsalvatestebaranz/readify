<?php
require "includes/auth_guard.php";
require "connect_db.php";

/* Validate book ID */
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$book_id = (int) $_GET["id"];

/* Fetch book */
$query = "SELECT book_id, title, price FROM books WHERE book_id = $book_id";
$result = mysqli_query($link, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    header("Location: index.php");
    exit;
}

$book = mysqli_fetch_assoc($result);

/* Initialize cart */
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

/* Add or increment */
if (isset($_SESSION["cart"][$book_id])) {
    $_SESSION["cart"][$book_id]["quantity"]++;
} else {
    $_SESSION["cart"][$book_id] = [
        "title"    => $book["title"],
        "price"    => (float) $book["price"],
        "quantity" => 1
    ];
}

/* Redirect back */
$redirect = $_SERVER["HTTP_REFERER"] ?? "index.php";
header("Location: $redirect");
exit;
?>
