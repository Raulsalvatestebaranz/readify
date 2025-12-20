<?php
// Start session
session_start();

require "connect_db.php";

// Check if book id is set
if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    // Get book details
    $q = "SELECT price, title FROM books WHERE book_id = $id";
    $r = mysqli_query($link, $q);

    if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

        // Initialise cart if not exists
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        // If book already in cart, increase quantity
        if (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]["quantity"]++;
        } else {
            // Add new item
            $_SESSION["cart"][$id] = [
                "quantity" => 1,
                "price" => $row["price"],
                "title" => $row["title"]
            ];
        }
    }
}

// Redirect back to home
header("Location: index.php");
exit();
?>
