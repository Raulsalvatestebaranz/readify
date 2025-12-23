<?php
require "includes/session.php";
require "connect_db.php";

if (empty($_POST["email"]) || empty($_POST["password"])) {
    $_SESSION["login_error"] = "Please enter both email and password.";
    header("Location: login.php");
    exit;
}

$email = mysqli_real_escape_string($link, $_POST["email"]);
$password_input = $_POST["password"];

$query = "
    SELECT user_id, first_name, password
    FROM users
    WHERE email = '$email'
    LIMIT 1
";
$result = mysqli_query($link, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    $_SESSION["login_error"] = "Invalid email or password.";
    header("Location: login.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password_input, $user["password"])) {
    $_SESSION["login_error"] = "Invalid email or password.";
    header("Location: login.php");
    exit;
}

/* Login success */
$_SESSION["user_id"] = $user["user_id"];
$_SESSION["first_name"] = $user["first_name"];
$_SESSION["login_success"] = "Welcome back, {$user['first_name']}!";

/* Redirect to last page or home */
$redirect = $_SESSION["redirect_after_login"] ?? "index.php";
unset($_SESSION["redirect_after_login"]);

header("Location: $redirect");
exit;
?>
