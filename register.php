<?php
require 'connect_db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['first_name'])) {
        $errors[] = 'Enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
    }

    if (empty($_POST['last_name'])) {
        $errors[] = 'Enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
    }

    if (empty($_POST['email'])) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'Enter your password.';
    }

    if (empty($errors)) {
        $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date)
              VALUES ('$fn', '$ln', '$e', '$p', NOW())";
        $r = mysqli_query($link, $q);

        if ($r) {
            echo '<p>You are now registered. <a href="login.php">Login</a></p>';
            exit();
        }
    }
}
?>

<h2>Register</h2>

<?php
if (!empty($errors)) {
    echo '<p>The following error(s) occurred:</p>';
    foreach ($errors as $msg) {
        echo "$msg<br>";
    }
}
?>

<form action="register.php" method="post">
    <input type="text" name="first_name" placeholder="First Name"><br>
    <input type="text" name="last_name" placeholder="Last Name"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="pass1" placeholder="Password"><br>
    <input type="password" name="pass2" placeholder="Confirm Password"><br>
    <input type="submit" value="Register">
</form>
