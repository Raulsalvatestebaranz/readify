<?php
// --------------------------------------------------
// Authentication Guard – READIFY
// Protects pages so only logged-in users can access them
// --------------------------------------------------

// Start the session and access session variables
require __DIR__ . "/session.php";

// --------------------------------------------------
// Check if the user is logged in
// --------------------------------------------------
if (!isset($_SESSION["user_id"])) {

    // Store the page the user tried to access
    // This allows redirecting back after login
    $_SESSION["redirect_after_login"] = $_SERVER["REQUEST_URI"];

    // Redirect unauthenticated users to the login page
    header("Location: login.php");
    exit;
}
