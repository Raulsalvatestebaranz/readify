<?php
require 'connect_db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['email'])) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    if (empty($_POST['pass'])) {
        $errors[] = 'Enter your password.';
    } else {
        $p = mysqli_real_escape_string($link, trim($_POST['pass']));
    }

    if (empty($errors)) {

        $q = "SELECT user_id, first_name, last_name
              FROM users
              WHERE email='$e' AND pass='$p'";

        $r = mysqli_query($link, $q);

        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];

            header('Location: index.php');
            exit();
        } else {
            $errors[] = 'Email and password not found.';
        }
    }
}

include 'login.php';
