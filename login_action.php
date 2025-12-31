<?php
// --------------------------------------------------
// Login Action – READIFY
// Processes login form submission and authenticates user
// --------------------------------------------------

// Start the session and ensure session variables are available
require "includes/session.php";

// Connect to the database
require "connect_db.php";

// --------------------------------------------------
// Validate input: email and password must be provided
// --------------------------------------------------
if (empty($_POST["email"]) || empty($_POST["password"])) {
    // Store error message in session
    $_SESSION["login_error"] = "Please enter both email and password.";
    // Redirect back to login page
    header("Location: login.php");
    exit;
}

// Sanitize email input
$email = mysqli_real_escape_string($link, $_POST["email"]);

// Store the password entered by the user
$password_input = $_POST["password"];

// --------------------------------------------------
// Retrieve user record from database by email
// --------------------------------------------------
$query = "
    SELECT user_id, first_name, password
    FROM users
    WHERE email = '$email'
    LIMIT 1
";
$result = mysqli_query($link, $query);

// If no user is found or query fails, login is invalid
if (!$result || mysqli_num_rows($result) !== 1) {
    $_SESSION["login_error"] = "Invalid email or password.";
    header("Location: login.php");
    exit;
}

// Fetch user data from query result
$user = mysqli_fetch_assoc($result);

// --------------------------------------------------
// Verify the entered password against the hashed password
// --------------------------------------------------
if (!password_verify($password_input, $user["password"])) {
    $_SESSION["login_error"] = "Invalid email or password.";
    header("Location: login.php");
    exit;
}

// --------------------------------------------------
// Login successful
// Store user data in session variables
// --------------------------------------------------
$_SESSION["user_id"] = $user["user_id"];
$_SESSION["first_name"] = $user["first_name"];
$_SESSION["login_success"] = "Welcome back, {$user['first_name']}!";

// --------------------------------------------------
// Redirect user to last requested page or home page
// --------------------------------------------------
$redirect = $_SESSION["redirect_after_login"] ?? "index.php";
unset($_SESSION["redirect_after_login"]);

header("Location: $redirect");
exit;
?>
