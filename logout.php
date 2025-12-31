<?php
// --------------------------------------------------
// Logout Action – READIFY
// Ends the user session and logs the user out
// --------------------------------------------------

// Start the session and access current session data
require "includes/session.php";

// --------------------------------------------------
// Destroy the current session safely
// --------------------------------------------------
session_unset();   // Remove all session variables
session_destroy(); // Destroy the session completely

// --------------------------------------------------
// Start a new session to store a logout message
// --------------------------------------------------
session_start();
$_SESSION["logout_success"] = "You have been logged out successfully.";

// Redirect the user to the home page
header("Location: index.php");
exit;
?>
